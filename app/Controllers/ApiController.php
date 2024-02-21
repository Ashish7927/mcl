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
        $City = $this->AdminModel->City();
        $Company = $this->AdminModel->Company();
        $Union = $this->AdminModel->Union();
        $Unionposition = $this->AdminModel->Unionposition();


        $response = [
            'status'   => 200,
            'error'    => null,
            'response' => [
                'message' => 'Here is the all master data',
                'department' => $department,
                'designation' => $designation,
                'city' => $City,
                'company' => $Company,
                'union' => $Union,
                'unionposition' => $Unionposition,

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

                if ($data[0]->status == 1) {
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
                            'message' => 'Your account is not Active, Please contact to Admin!'
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

                    $profileStatus = 0;
                    if ($data[0]->password != NULL || $data[0]->password != '') {
                        $profileStatus = 1;
                    }

                    if ($data[0]->adhar_no != NULL || $data[0]->adhar_no != '') {
                        $profileStatus = 2;
                    }
                    $response = [
                        'status'   => 201,
                        'error'    => null,
                        'response' => [
                            'success' => 'OTP matched',
                            'userDetails' => $data,
                            'profile_status' => $profileStatus
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
            'email' => 'required|is_unique[user.email]',
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

            $email = $this->request->getVar('email');
            $name = $this->request->getVar('name');
            $eis_no = $this->request->getVar('eis_no');
            $department_id = $this->request->getVar('department_id');
            $area = $this->request->getVar('area');
            $wp_no = $this->request->getVar('wp_no');
            $designation_id = $this->request->getVar('designation_id');

            $img = $this->request->getPost('profile_image');
            $filename = '';
            if ($img) {
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $file_data = base64_decode($img);
                $image_name = md5(uniqid(rand(), true));
                $filename = $image_name . '.' . 'png';
                $path = 'upload/';
                file_put_contents($path . $filename, $file_data);
            }

            $data_array = [
                'full_name' => $name,
                'email' => $email,
                'contact_no' => $wp_no,
                'eis_no' => $eis_no,
                'member_desgn_id' => $designation_id,
                'member_dept_id' => $department_id,
                'joining_date' => date('Y-m-d'),
                'user_name' => strtolower(str_replace(' ', '_', $name)),
                'city_id' => $area,
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

    public function updatePassword()
    {
        $rules = [
            'esi_no' => 'required|numeric|exact_length[8]',
            'password' => 'required'
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
            $esi_no = $this->request->getVar('esi_no');
            $data = $this->AdminModel->checkUserEsino($esi_no);
            if (!empty($data) && $data != null) {

                $password = $this->request->getVar('password');
                $updatepassword = [
                    'password' => base64_encode(base64_encode($password))
                ];
                $result = $this->AdminModel->UpdateProfile($updatepassword, $data[0]->id);
                if ($result) {
                    $response = [
                        'status'   => 200,
                        'error'    => null,
                        'response' => [
                            'success' => 'Password updated Successfully'
                        ],
                    ];
                } else {
                    $response = [
                        'status'   => 200,
                        'error'    => 1,
                        'response' => [
                            'message' => 'Password updated failed!, Something went wrong.'
                        ]
                    ];
                }
            } else {
                $response = [
                    'status'   => 200,
                    'error'    => 1,
                    'response' => [
                        'message' => 'Invalid ESI No'
                    ]
                ];
            }
        }
        return $this->respondCreated($response);
    }

    public function updateProfile()
    {

        $rules = [
            'adhar_no' => 'required|numeric',
            'user_id' => 'required|numeric'
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

            $user_id = $this->request->getVar('user_id');
            $userDtls = $this->AdminModel->userdata($user_id);
            if (!empty($userDtls) && $userDtls != null) {
                $dob = $this->request->getVar('dob');
                $blood_group = $this->request->getVar('blood_group');
                $adhar_no = $this->request->getVar('adhar_no');
                $joining_date = $this->request->getVar('joining_date');
                $marital_status = $this->request->getVar('marital_status');
                $spouse_name = $this->request->getVar('spouse_name');
                $no_of_children = $this->request->getVar('no_of_children');
                $address1 = $this->request->getVar('address');
                $gender = $this->request->getVar('gender');
                $alter_number = $this->request->getVar('alter_number');
                $office_name = $this->request->getVar('office_name');
                $office_location = $this->request->getVar('office_location');
                $office_union = $this->request->getVar('office_union');
                $position_in_union = $this->request->getVar('position_in_union');



                $img = $this->request->getPost('profile_image');
                if ($img) {
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace('data:image/jpeg;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $file_data = base64_decode($img);
                    $image_name = md5(uniqid(rand(), true));
                    $filename = $image_name . '.' . 'png';
                    $path = 'upload/blog/';
                    file_put_contents($path . $filename, $file_data);
                    $updateImage = [
                        'profile_image' => $filename
                    ];

                    $data = $this->AdminModel->UpdateProfile($updateImage, $user_id);
                }

                $data_array = [
                    'dob' => $dob,
                    'blood_group' => $blood_group,
                    'adhar_no' => $adhar_no,
                    'joining_dateinbranchoffice' => $joining_date,
                    'marital_status' => $marital_status,
                    'spouse_name' => $spouse_name,
                    'no_of_children' => $no_of_children,
                    'address1' => $address1,
                    'gender' => $gender,
                    'alter_cnum' => $alter_number,
                    'office_name' => $office_name,
                    'office_location' => $office_location,
                    'office_union' => $office_union,
                    'position_in_union' => $position_in_union,
                ];

                $result = $this->AdminModel->UpdateProfile($data_array, $user_id);
                if ($result) {
                    $response = [
                        'status'   => 201,
                        'error'    => null,
                        'response' => [
                            'success' => 'User profile updated Successfully'
                        ],
                    ];
                } else {
                    $response = [
                        'status'   => 200,
                        'error'    => 1,
                        'response' => [
                            'message' => 'update failed!, Something went wrong.'
                        ]
                    ];
                }
            } else {
                $response = [
                    'status'   => 200,
                    'error'    => 1,
                    'response' => [
                        'message' => 'User not found!'
                    ]
                ];
            }
        }
        return $this->respondCreated($response);
    }

    public function createPost()
    {
        $rules = [
            'user_id' => 'required|numeric',
            'content' => 'required',
            'post_type' => 'required|numeric'
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
            $user_id = $this->request->getVar('user_id');
            $userDtls = $this->AdminModel->userdata($user_id);
            if (!empty($userDtls) && $userDtls != null) {

                $content = $this->request->getVar('content');
                $post_type = $this->request->getVar('post_type');
                $data_array = [
                    'post_content' => $content,
                    'user_id' => $user_id,
                    'post_type' => $post_type,
                    'status' => 1
                ];
                $insert_id = $this->AdminModel->createPost($data_array);

                $images = $this->request->getPost('post_images');
                if (is_array($images)) {
                    if (count($videos) > 3) {
                        $response = [
                            'status'   => 200,
                            'error'    => 1,
                            'response' => [
                                'message' => 'number of image upload limit exceed'
                            ]
                        ];
                        return $this->respondCreated($response);
                    }
                    foreach ($images as $img) {
                        $filename = '';
                        if ($img) {
                            $img = str_replace('data:image/png;base64,', '', $img);
                            $img = str_replace('data:image/jpeg;base64,', '', $img);
                            $img = str_replace(' ', '+', $img);
                            $file_data = base64_decode($img);
                            $image_name = md5(uniqid(rand(), true));
                            $filename = $image_name . '.' . 'png';
                            $path = 'upload/post/';
                            file_put_contents($path . $filename, $file_data);

                            $imageData = [
                                'post_id' => $insert_id,
                                'image_name' => $filename,
                                'image_path' => 'upload/post/'
                            ];
                            $result = $this->AdminModel->inserPostImage($imageData);
                        }
                    }
                }

                $videos = $this->request->getPost('post_videos');
                if (is_array($videos)) {
                    if (count($videos) > 3) {
                        $response = [
                            'status'   => 200,
                            'error'    => 1,
                            'response' => [
                                'message' => 'number of Video upload limit exceed'
                            ]
                        ];
                        return $this->respondCreated($response);
                    }
                    foreach ($videos as $vdo) {
                        $filename = '';
                        if ($vdo) {
                            $vdo = str_replace('data:image/png;base64,', '', $vdo);
                            $vdo = str_replace('data:image/jpeg;base64,', '', $vdo);
                            $vdo = str_replace(' ', '+', $vdo);
                            $file_data = base64_decode($vdo);
                            $image_name = md5(uniqid(rand(), true));
                            $filename = $image_name . '.' . 'mp4';
                            $path = 'upload/post/';
                            file_put_contents($path . $filename, $file_data);

                            $videoData = [
                                'post_id' => $insert_id,
                                'video_file' => $filename,
                                'video_path' => 'upload/post/'
                            ];
                            $result = $this->AdminModel->inserPostVideo($videoData);
                        }
                    }
                }

                if ($insert_id) {
                    $response = [
                        'status'   => 201,
                        'error'    => null,
                        'response' => [
                            'success' => 'Post created Successfully'
                        ],
                    ];
                } else {
                    $response = [
                        'status'   => 200,
                        'error'    => 1,
                        'response' => [
                            'message' => 'Post creation failed!, Something went wrong.'
                        ]
                    ];
                }
            } else {
                $response = [
                    'status'   => 200,
                    'error'    => 1,
                    'response' => [
                        'message' => 'User not found!'
                    ]
                ];
            }
        }
        return $this->respondCreated($response);
    }

    public function getGeneralPost()
    {
        $Posts = $this->AdminModel->getPost(1);
        $response = [
            'status'   => 200,
            'error'    => null,
            'response' => [
                'message' => 'Here is the all general post data',
                'Posts' => $Posts,

            ],
        ];
        return $this->respondCreated($response);
    }

    public function getPresidentPost()
    {
        $Posts = $this->AdminModel->getPost(2);
        $response = [
            'status'   => 200,
            'error'    => null,
            'response' => [
                'message' => 'Here is the all president post data',
                'Posts' => $Posts,

            ],
        ];
        return $this->respondCreated($response);
    }

    public function memeberListForApproval()
    {
        $memeberList = $this->AdminModel->GetAllUserList(2);

        $response = [
            'status'   => 200,
            'error'    => null,
            'response' => [
                'message' => 'Here is the all memeber data for approveal',
                'memeberList' => $memeberList
            ],
        ];

        return $this->respondCreated($response);
    }

    public function approveMemebr()
    {
        $rules = [
            'memeber_id' => 'required|numeric',
            'user_id' => 'required|numeric'
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
            $user_id = $this->request->getVar('user_id');
            $userDtls = $this->AdminModel->userdata($user_id);
            if (!empty($userDtls) && $userDtls != null && $userDtls[0]->user_type != 1) {

                $memeber_id = $this->request->getVar('memeber_id');
                $updateStatus = [
                    'status' => 1
                ];
                $result = $this->AdminModel->UpdateProfile($updateStatus, $memeber_id);
                if ($result) {
                    $response = [
                        'status'   => 200,
                        'error'    => null,
                        'response' => [
                            'success' => 'Member approved Successfully'
                        ],
                    ];
                } else {
                    $response = [
                        'status'   => 200,
                        'error'    => 1,
                        'response' => [
                            'message' => 'Member approved failed!, Something went wrong.'
                        ]
                    ];
                }
            } else {
                $response = [
                    'status'   => 200,
                    'error'    => 1,
                    'response' => [
                        'message' => 'Invalid user_id'
                    ]
                ];
            }
        }
        return $this->respondCreated($response);
    }

    public function globalMemberList()
    {
        $memeberList = $this->AdminModel->GetAllActiveUserList(2);

        $response = [
            'status'   => 200,
            'error'    => null,
            'response' => [
                'message' => 'Here is the all member data',
                'memeberList' => $memeberList
            ],
        ];

        return $this->respondCreated($response);
    }

    public function localMemberList()
    {
        $rules = [
            'user_id' => 'required|numeric'
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
            $user_id = $this->request->getVar('user_id');
            $userDtls = $this->AdminModel->userdata($user_id);
            if (!empty($userDtls) && $userDtls != null && $userDtls[0]->city_id != '') {

                $memeberList = $this->AdminModel->getLocalMember($userDtls[0]->city_id);

                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'response' => [
                        'success' => 'Here is the all local member',
                        'memeberList' => $memeberList
                    ],
                ];
            } else {
                $response = [
                    'status'   => 200,
                    'error'    => 1,
                    'response' => [
                        'message' => 'Invalid user_id'
                    ]
                ];
            }
        }
        return $this->respondCreated($response);
    }

    public function getProfileDetails()
    {
        $rules = [
            'user_id' => 'required|numeric'
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
            $user_id = $this->request->getVar('user_id');
            $userDtls = $this->AdminModel->userdata($user_id);
            if (!empty($userDtls) && $userDtls != null) {

                $profileDetails = $this->AdminModel->getProfileDetails($user_id);

                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'response' => [
                        'success' => 'Here is the all local member',
                        'profileDetails' => $profileDetails
                    ],
                ];
            } else {
                $response = [
                    'status'   => 200,
                    'error'    => 1,
                    'response' => [
                        'message' => 'User not found'
                    ]
                ];
            }
        }
        return $this->respondCreated($response);
    }
}
