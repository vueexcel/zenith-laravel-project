<?php

namespace App\Http\Controllers;

use App\Models\HealthConcern;
use App\Models\Member;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class MembersController extends Controller
{
    use ResourceController;

    protected $resourceAlias = 'members';

    protected $resourceRoutesAlias = 'members';

    protected $resourceModel = Member::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Member List';

    /**
     * Used to validate store.
     *
     * @return array
     */
    private function resourceStoreValidationData()
    {
        return [
            'rules' => [
                'member_no' => 'required',
                'surname' => 'required|min:3|max:255',
                'name' => 'required|min:3|max:255',

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
                'member_no' => 'required',
                'surname' => 'required|min:3|max:255',
                'name' => 'required|min:3|max:255',
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
        $values = [];
        $values['member_no'] = $request->input('member_no', '');
        $values['surname'] = $request->input('surname', '');
        $values['name'] = $request->input('name', '');
        $values['title'] = $request->input('title', '');
        $values['birthday'] = $request->input('birthday', '');
        if($values['birthday'] != "")
            $values['birthday'] = $this->convertDateString($values['birthday']);
        else
            $values['birthday'] = null;
        $values['gender'] = $request->input('gender', '');
        $values['address1'] = $request->input('address1', '');
        $values['address2'] = $request->input('address2', '');
        $values['address3'] = $request->input('address3', '');
        $values['postal'] = $request->input('postal', '');
        $values['phone'] = $request->input('phone', '');
        $values['group_code'] = $request->input('group_code', '');
        $values['section'] = $request->input('section', '');
        $values['department'] = $request->input('department', '');
        $values['division'] = $request->input('division', '');
        $values['occupation'] = $request->input('occupation', '');
        $values['status'] = $request->input('status', '');

        $values['start_date'] = $request->input('start_date', '');
        if($values['start_date'] != "")
            $values['start_date'] = $this->convertDateString($values['start_date']);

        $values['leaving_date'] = $request->input('leaving_date', '');
        if($values['leaving_date'] != "")
            $values['leaving_date'] = $this->convertDateString($values['leaving_date']);

        $values['ni_number'] = $request->input('ni_number', '');
        $values['user_id'] = Auth::user()->id;
        $values['is_delete'] = 0;

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
                $query->where('name', 'like', "%$search%")
                    ->orWhere('surname', 'like', "%$search%")
                    ->orWhere('member_no', $search)
                    ->orWhere('title', 'like', "%$search%")
                    ->orWhere('group_code', 'like', "%$search%")
                    ->orWhere('division', 'like', "%$search%")
                    ->orWhere('occupation', 'like', "%$search%")
                    ->orWhere('department', 'like', "%$search%");
            });
        })->orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function get_member(Request $request)
    {
        $id = $request->get('id');
        if($id) {
            $member = Member::find($id);
            return response()->json(['member'=>$member]);
        } else {
            return response()->json(['member'=>null]);
        }
    }

    public function add_member(Request $request)
    {
        $request->validate([
            'member_no' => 'required|unique:members,member_no',
        ]);

        $member = new Member();
        $member->member_no = $request->get('member_no');
        $member->is_deleted = 0;
        $member->surname = '';
        $member->name = '';
        $result = $member->save();
        if($result)
            return response()->json(['result'=>'ok', 'member_id' => $member->id]);
        else
            return response()->json(['result'=>'fail']);

    }

    public function find(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $tags = Member::where("member_no", "like", '%'.$term.'%')->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->member_no];
        }

        return \Response::json($formatted_tags);
    }

    public function getList(Request $request)
    {
        if(\request()->ajax()){
            $members = Member::where('is_deleted', 0);
            return DataTables::eloquent($members)
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group">';
                    $button .= '<a href="'.route($this->resourceRoutesAlias.'.edit', $data->id).'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>';
                    $button .= '<a href="#" class="btn btn-danger btn-sm btnOpenerModalConfirmModelDelete" data-form-id="formDeleteModel_'.$data->id.'"><i class="fa fa-trash-o"></i></a>';
                    $button .= '</div>';
                    $button .= '<form id="formDeleteModel_'.$data->id.'" action="'.route($this->resourceRoutesAlias.'.destroy', $data->id).'" method="POST" style="display: none;" class="hidden form-inline">';
                    $button .= csrf_field();
                    $button .= '<input type="hidden" name="_method" value="DELETE">';
                    $button .= '<button type="submit" class="btn btn-danger">Delete</button>';
                    $button .= '</form>';

                    return $button;
                })
                ->toJson();
        }
    }
}
