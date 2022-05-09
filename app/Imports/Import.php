<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation
{
    use Importable;


    public $data_return = ['count_updated' => 0, 'count_create' => 0, 'department_name' => ''];
    public $department_name = [];

    /**
     * @param array $row
     *
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // xử lý trạng thái làm việc
            (Str::lower($row['status']) == 'đang làm việc') ? $status = STATUS_WORKING : $status = STATUS_QUIT;
            // xử lý chức vụ 
            (Str::lower($row['position']) == 'quản lý') ? $is_manager = MANAGER_ROLE : $is_manager = MEMBER_ROLE;
            // xử lý quyền quản trị
            (Str::lower($row['admin']) == 'true') ? $is_admin = IS_ADMIN : $is_admin = IS_NOT_ADMIN;
            // kiểm tra tên phòng đã tồn tại hay chưa
            $exists_department = Department::where('name', $row['department_name'])->first();
            // nếu tên phòng đã tồn tại thì lấy id còn chưa tồn tại thì tạo mới
            if ($exists_department) {
                $department_id = $exists_department->id;
            } else {
                $department = Department::create([
                    'name' => $row['department_name'],
                ]);

                $department_id = Department::where('name', $row['department_name'])->first()->id;
                ($department) ? array_push($this->department_name, $row['department_name']) : '';
            }
            // kiểm tra email user đã tồn tại hay chưa
            $exists_user = User::where('email', $row['email'])->first();
            // nếu email chưa tồn tại thì tạo mới, tồn tại thì cập nhật


            if ($exists_user) {
                $updated = $exists_user->update([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'birthday' => $row['birthday'],
                    'department_id' => $department_id,
                    'status' => $status,
                    'is_manager' => $is_manager,
                    'is_admin' => $is_admin,
                    'start_work' => $row['start_work'],

                ]);

                ($updated) ? $this->data_return['count_update']++ : $this->data_return['count_update'];
            } else {

                $create = User::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    // 'birthday' => $this->transformDate($row['birthday']).
                    'birthday' => $row['birthday'],
                    // 'start_work' => $this->transformDate($row['start_work']),
                    'start_work' => $row['start_work'],
                    'status' => $status,
                    'is_manager' => $is_manager,
                    'is_admin' => $is_admin,
                    'department_id' => $department_id,

                ]);
                ($create) ? $this->data_return['count_create']++ : $this->data_return['count_create'];
            }
        }
    }
    public function rules(): array
    {
        return [
            '*.name' => 'bail|required|min:3|max:30',
            '*.email' => 'bail|required|email',
            '*.phone' => 'nullable|regex:/(0[1-9]{2})[0-9]{7}/',
            '*.birthday' => 'bail|date|required|before:today',
            '*.start_work' => 'bail|required|before:today',
            // '*.department_id' => 'bail|required|numeric',
            // '*.department_name' => 'bail|required|min:3|max:50',
            '*.status' => ['bail', 'required', new StatusExcelRule()],
            '*.position' => ['required', new PositionExcelRule()],
            '*.is_admin' => ['nullable', new AdminExcelRule()],


        ];
    }
    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'phone.regex' => 'Số điện thoại không đúng định dạng',
        ];
    }
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
    /**
     * Return total: user create and update,department create 
     * @return array
     */

    public function getDataReturn(): array
    {
        $this->data_return['department_name'] = array_unique($this->department_name);

        return $this->data_return;
    }
}