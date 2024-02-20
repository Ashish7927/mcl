<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AdminModel;

class ApiController extends ResourceController
{

    public function __construct()
    {
        $db = db_connect();
        $this->db = db_connect();

        $this->AdminModel = new AdminModel($db);
        $this->session = session();
        helper(['form', 'url', 'validation']);
    }

    public function index()
    {
        $response = [
            'status'   => 200,
            'error'    => null,
            'response' => [
                'message' => 'CodeIgniter-4, Rest-API working fine.'
            ],
        ];
        return $this->respondCreated($response);
    }

    public function masterData()
    {
        $department = $this->AdminModel->Department();
        $designation = $this->AdminModel->Designation();

        $response = [
            'status'   => 200,
            'error'    => null,
            'response' => [
                'message' => 'Here is the all master data',
                'department' => $department,
                'designation' => $designation,
            ],
        ];

        return $this->respondCreated($response);
    }

    public function sendOtpForLogin()
    {
        $phone = $this->request->getVar('phone');
        if ($phone != '') {
            $data = $this->AdminModel->checkUserPahone($phone);
            if (!empty($data) && $data != null) {

                //Send otp

                $otp = rand(100000, 999999);
                $updateotp = [
                    'otp' => $otp
                ];

                $data = $this->AdminModel->UpdateProfile($updateotp, $data[0]->id);


                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'response' => [
                        'message' => 'Otp send successfully!',
                        'otp' => $otp,
                    ],
                ];
            } else {
                $response = [
                    'status'   => 200,
                    'error'    => 1,
                    'response' => [
                        'message' => 'Enter Phone number is not registered'
                    ]
                ];
            }
        } else {
            $response = [
                'status'   => 200,
                'error'    => 1,
                'response' => [
                    'message' => 'please fill the phone number'
                ]
            ];
        }
        return $this->respondCreated($response);
    }

    public function verifyOtpForLogin()
    {
        $phone = $this->request->getVar('phone');
        $otp = $this->request->getVar('entered_otp');
        if ($phone != '' && $otp != '') {
            $data = $this->AdminModel->checkUserPahone($phone);
            if (!empty($data) && $data != null) {

                //verify otp
                $actuallOtp = $data[0]->otp;
                if ($otp == $actuallOtp) {
                    $response = [
                        'status'   => 201,
                        'error'    => null,
                        'response' => [
                            'success' => 'OTP matched',
                            'userDetails' => $data,
                        ],
                    ];
                } else {
                    $response = [
                        'status'   => 200,
                        'error'    => 1,
                        'response' => [
                            'message' => 'Invalid OTP'
                        ]
                    ];
                }
            } else {
                $response = [
                    'status'   => 200,
                    'error'    => 1,
                    'response' => [
                        'message' => 'Enter Phone number is not registered'
                    ]
                ];
            }
        } else {
            $response = [
                'status'   => 200,
                'error'    => 1,
                'response' => [
                    'message' => 'please fill the phone number & Otp'
                ]
            ];
        }
        return $this->respondCreated($response);
    }

    public function register()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'wp_no' => 'required|numeric|exact_length[10]|is_unique[user.contact_no]',
            'eis_no' => 'required|numeric|exact_length[8]|is_unique[user.eis_no]',
            'department_id' => 'required|numeric',
            'designation_id' => 'required|numeric',
            'area' => 'required'
        ];

        if (!$this->validate($rules)) {
            $response = [
                'status'   => 200,
                'error'    => 1,
                'response' => [
                    'message' => $this->validator->getErrors()
                ]
            ];
        } else {

            $name = $this->request->getVar('name');
            $eis_no = $this->request->getVar('eis_no');
            $department_id = $this->request->getVar('department_id');
            $area = $this->request->getVar('area');
            $wp_no = $this->request->getVar('wp_no');
            $designation_id = $this->request->getVar('designation_id');

            // $file = $this->request->getFile('image');
            // if ($file->isValid() && !$file->hasMoved()) {
            //     $imagename = $file->getRandomName();
            //     $file->move('uploads/', $imagename);
            // } else {
            //     $imagename = "";
            // }

            $img = $this->request->getPost('profile_image');
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace('data:image/jpeg;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $file_data = base64_decode($img);
            $image_name = md5(uniqid(rand(), true));
            $filename = $image_name . '.' . 'png';
            $path = 'upload/blog/';
            file_put_contents($path . $filename, $file_data);

            $data_array = [
                'full_name' => $name,
                'contact_no' => $wp_no,
                'eis_no' => $eis_no,
                'member_desgn_id' => $designation_id,
                'member_dept_id' => $department_id,
                'joining_date' => date('Y-m-d'),
                'user_name' => strtolower(str_replace(' ', '_', $name)),
                'address1' => $area,
                'status' => 0,
                'profile_image' => $filename,
                'user_type' => 2,
            ];

            $result = $this->AdminModel->adduser($data_array);
            if ($result) {
                $response = [
                    'status'   => 201,
                    'error'    => null,
                    'response' => [
                        'success' => 'User registered Successfully'
                    ],
                ];
            } else {
                $response = [
                    'status'   => 200,
                    'error'    => 1,
                    'response' => [
                        'message' => 'Registration failed!, Something went wrong.'
                    ]
                ];
            }
        }

        return $this->respondCreated($response);
    }




    // // create
    // public function create() {
    //     $model = new EmployeeModel();
    //     $data = [
    //         'name' => $this->request->getVar('name'),
    //         'email'  => $this->request->getVar('email'),
    //     ];
    //     $model->insert($data);
    //     $response = [
    //       'status'   => 201,
    //       'error'    => null,
    //       'response' => [
    //           'success' => 'Employee created successfully'
    //       ]
    //   ];
    //   return $this->respondCreated($response);
    // }
    // // single user
    // public function show($id = null){
    //     $model = new EmployeeModel();
    //     $data = $model->where('id', $id)->first();
    //     if($data){
    //         return $this->respond($data);
    //     }else{
    //         return $this->failNotFound('No employee found');
    //     }
    // }
    // // update
    // public function update($id = null){
    //     $model = new EmployeeModel();
    //     $id = $this->request->getVar('id');
    //     $data = [
    //         'name' => $this->request->getVar('name'),
    //         'email'  => $this->request->getVar('email'),
    //     ];
    //     $model->update($id, $data);
    //     $response = [
    //       'status'   => 200,
    //       'error'    => null,
    //       'response' => [
    //           'success' => 'Employee updated successfully'
    //       ]
    //   ];
    //   return $this->respond($response);
    // }
    // // delete
    // public function delete($id = null){
    //     $model = new EmployeeModel();
    //     $data = $model->where('id', $id)->delete($id);
    //     if($data){
    //         $model->delete($id);
    //         $response = [
    //             'status'   => 200,
    //             'error'    => null,
    //             'response' => [
    //                 'success' => 'Employee successfully deleted'
    //             ]
    //         ];
    //         return $this->respondDeleted($response);
    //     }else{
    //         return $this->failNotFound('No employee found');
    //     }
    // }
}
