<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controllers\ResourceController;
use DataTables;

class UsersController extends Controller
{
    use ResourceController;

    /**
     * @var string
     */
    protected $resourceAlias = 'admin.users';

    /**
     * @var string
     */
    protected $resourceRoutesAlias = 'admin::users';

    /**
     * Fully qualified class name
     *
     * @var string
     */
    protected $resourceModel = User::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Users';

    /**
     * Used to validate store.
     *
     * @return array
     */
    private function resourceStoreValidationData()
    {
        return [
            'rules' => [
                'name' => 'required|min:3|max:255',
                'password' => 'required|confirmed|min:6',
                'logo_number' => 'required|in:' . implode(',', Utils::getLogosNumber()),
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
                'name' => 'required|min:3|max:255',
                'password' => 'nullable|confirmed|min:6',
                'logo_file' => 'max:1024',
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
        $creating = is_null($record);
        $values = [];
        $values['name'] = $request->input('name', '');
        $values['email'] = $request->input('email', '');
        $values['surname'] = $request->input('surname', '');
        $values['is_admin'] = $request->input('is_admin', '0');
        $values['is_hr'] = $request->input('is_hr', '0');
        /*if ($record && Auth::user()->id == $record->id) {
            $values['is_admin'] = Auth::user()->is_admin;
        }*/
        $values['logo_number'] = Utils::getValidLogoNumber($request->input('logo_number', 1));
        // If creating user or providing password.
        $password = $request->input('password', null);
        if ($creating || !empty($password)) {
            $values['password'] = $password;
        }

        $logo_file = $request->file('avatar');

        if($logo_file) {
            $logo_file_name = rand() . '.' . $logo_file->getClientOriginalExtension();
            $logo_file->move(public_path("avatars"), $logo_file_name);
            $values['avatar'] = $logo_file_name;
        }

        $values['is_deleted'] = 0;
        $values['member_no'] = $request->input('member_no', '');
        return $values;
    }

    private function alterValuesToSave(Request $request, $values)
    {
        if (array_key_exists('password', $values)) {
            if (!empty($values['password'])) {
                $values['password'] = Hash::make($values['password']);
            } else {
                unset($values['password']);
            }
        }

        return $values;
    }

    /**
     * @param $record
     * @return bool
     */
    private function checkDestroy($record)
    {
        if (Auth::user()->id == $record->id) {
            flash()->error('You can not delete your own user.');

            return false;
        }

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
                    ->orWhere('email', 'like', "%$search%");
            });
        })->paginate($perPage);
    }


    public function getList(Request $request)
    {
        if(\request()->ajax()){
            $users = User::where('is_deleted', 0);
            return DataTables::eloquent($users)
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
