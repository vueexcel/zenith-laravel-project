<?php

namespace App\Traits\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait ResourceController
{
    use ResourceHelper;

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewList', $this->getResourceModel());
        $paginatorData = [];
        $perPage = (int) $request->input('per_page', '');
        $perPage = (is_numeric($perPage) && $perPage > 0 && $perPage <= 100) ? $perPage : 15;
        if ($perPage != 15) {
            $paginatorData['per_page'] = $perPage;
        }
        $search = trim($request->input('search', ''));
        if (! empty($search)) {
            $paginatorData['search'] = $search;
        }
        $records = $this->getSearchRecords($request, $perPage, $search);

        $records->appends($paginatorData);

        return view($this->filterIndexView('_resources.index'), $this->filterSearchViewData($request, [
            'records' => $records,
            'search' => $search,
            'resourceAlias' => $this->getResourceAlias(),
            'resourceRoutesAlias' => $this->getResourceRoutesAlias(),
            'resourceTitle' => $this->getResourceTitle(),
            'perPage' => $perPage,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->getResourceModel());

        $class = $this->getResourceModel();
        return view($this->filterCreateView('_resources.create'), $this->filterCreateViewData([
            'record' => new $class(),
            'resourceAlias' => $this->getResourceAlias(),
            'resourceRoutesAlias' => $this->getResourceRoutesAlias(),
            'resourceTitle' => $this->getResourceTitle(),
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->getResourceModel());

        $valuesToSave = $this->getValuesToSave($request);
        $request->merge($valuesToSave);
        $this->resourceValidate($request, 'store');

        if ($record = $this->getResourceModel()::create($this->alterValuesToSave($request, $valuesToSave))) {
            if($this->resourceAlias == "health_concerns" && $valuesToSave['origin_type_id'] == 1) {
                flash()->success('Element successfully inserted.');
                flash()->success('Accident form generated.');
            } else {
                flash()->success('Element successfully inserted.');
            }

            $this->save_history($record->id);
            return $this->getRedirectAfterSave($record);
        } else {
            flash()->info('Element was not inserted.');
        }



        return $this->redirectBackTo(route($this->getResourceRoutesAlias().'.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route($this->getResourceRoutesAlias().'.edit', $id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $record = $this->getResourceModel()::findOrFail($id);
        $this->authorize('update', $record);
        return view($this->filterEditView('_resources.edit'), $this->filterEditViewData($record, [
            'record' => $record,
            'resourceAlias' => $this->getResourceAlias(),
            'resourceRoutesAlias' => $this->getResourceRoutesAlias(),
            'resourceTitle' => $this->getResourceTitle(),
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $record = $this->getResourceModel()::findOrFail($id);

        $this->authorize('update', $record);

        $valuesToSave = $this->getValuesToSave($request, $record);
        $request->merge($valuesToSave);
        $this->resourceValidate($request, 'update', $record);

        if ($record->update($this->alterValuesToSave($request, $valuesToSave))) {
            flash()->success('Element successfully updated.');

            $this->save_history($record->id);

            return $this->getRedirectAfterSave($record);
        } else {
            flash()->info('Element was not updated.');
        }

        return $this->redirectBackTo(route($this->getResourceRoutesAlias().'.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $record = $this->getResourceModel()::findOrFail($id);

        $this->authorize('delete', $record);

        if (! $this->checkDestroy($record)) {
            return redirect(route($this->getResourceRoutesAlias().'.index'));
        }

        $record->is_deleted = 1;

        if ($record->save()) {
            flash()->success('Element successfully deleted.');
        } else {
            flash()->info('Element was not deleted.');
        }

        /*if ($record->delete()) {
            flash()->success('Element successfully deleted.');
        } else {
            flash()->info('Element was not deleted.');
        }*/

        return $this->redirectBackTo(route($this->getResourceRoutesAlias().'.index'));
    }

    public function convertDateString($date)
    {
        if($date != "") {
            $string = explode("/", $date);
            return $string[2] . '-' . $string[1] . '-' . $string[0];
        } else
            return "";

    }

    public function save_history($record_id)
    {
        //Insert History
        $user_id = Auth::user()->id;
        $history = new History();
        $history->user_id = $user_id;
        switch ($this->resourceAlias) {
            case 'members' : $history->member_id = $record_id; break;
            case 'accidents' : $history->accident_id = $record_id; break;
            case 'contractor_accidents' : $history->contractor_accident_id = $record_id; break;
            case 'health_concerns' : $history->health_concern_id = $record_id;  break;
            case 'reduced_flexibilities' : $history->reduced_flexibility_id = $record_id; break;
            case 'workplace_investigations' : $history->workplace_investigation_id = $record_id;  break;
        }
        $history->save();
    }
}
