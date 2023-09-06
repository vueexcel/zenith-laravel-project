<?php

namespace App\Http\Controllers;

use App\Models\QuickNearMiss;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuickNearMissesController extends Controller
{
    //
    use ResourceController;

    protected $resourceAlias = 'quick_near_misses';

    protected $resourceRoutesAlias = 'quick_near_misses';

    protected $resourceModel = QuickNearMiss::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Quick Near Miss';

    /**
     * Used to validate store.
     *
     * @return array
     */
    private function resourceStoreValidationData()
    {
        return [
            'rules' => [
                'member_id' => 'required',
                'incident_date' => 'required'
            ],
            'messages' => [],
            'attributes' => [],
        ];
    }

    /**
     * Used to validate update.
     *
     * @param $record
     * @return array
     */
    private function resourceUpdateValidationData($record)
    {
        return [
            'rules' => [
                'member_id' => 'required',
                'incident_date' => 'required'
            ],
            'messages' => [],
            'attributes' => [],
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param null $record
     * @return array
     */
    private function getValuesToSave(Request $request, $record = null)
    {
        //$creating = is_null($record);
        $values = [];
        $values['member_id'] = $request->input('member_id', '');
        $values['group_code_id'] = $request->input('group_code_id', '');
        $values['incident_date'] = $request->input('incident_date', '');
        $values['supervisor'] = $request->input('supervisor', '');
        $values['nature_incident'] = $request->input('nature_incident', '');
        $values['initial_countermeasure'] = $request->input('initial_countermeasure', '');
        $values['completed'] = $request->input('completed', '');
        $values['stop_6'] = $request->input('stop_6', '');
        $values['causation_factor_id'] = $request->input('causation_factor_id', '');
        $values['logged_date'] = date('Y-m-d');
        $values['user_id'] = Auth::user()->id;

        return $values;
    }

    private function alterValuesToSave(Request $request, $values)
    {
        return $values;
    }

    /**
     * @param $record
     * @return bool
     */
    private function checkDestroy($record)
    {
        return true;
    }

    /**
     * Retrieve the list of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $perPage
     * @param string|null $search
     * @return \Illuminate\Support\Collection
     */
    private function getSearchRecords(Request $request, $perPage = 15, $search = null)
    {
        return $this->getResourceModel()::where('is_deleted', 0)->when(! empty($search), function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('incident_date', 'like', "%$search%")
                    ->orWhere('supervisor', 'like', "%$search%");
            });
        })->orderBy('updated_at', 'desc')->paginate($perPage);
    }
}
