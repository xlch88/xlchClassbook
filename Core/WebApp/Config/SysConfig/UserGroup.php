<?php
return <<<FlandreStudio_JSON
{
    "Guest": {
        "Name": "游客",
        "Type": "Guest",
        "Color": "green",
        "Permission": {
            "Page": {
                "Account": {
                    "Allow": true,
                    "Mod2": {
                        "Index": true,
                        "Register": true,
                        "ResetPassword": true
                    }
                },
                "Welcome": {
                    "Allow": true,
                    "Mod2": {
                        "All": true
                    }
                },
                "All": {
                    "Allow": false
                }
            },
            "Function": {
                "User": {
                    "Allow": false,
                    "Do": {
                        "Register": true,
                        "Login": true
                    }
                },
                "VCode": {
                    "Allow": true
                },
                "All": {
                    "Allow": false
                }
            },
            "All": {
                "Allow": false
            }
        }
    },
    "Default": {
        "Name": "学生",
        "Color": "CornflowerBlue",
        "Type": "User",
        "Permission": {
            "All": {
                "Allow": true
            },
            "Page": {
                "Admin": {
                    "Allow": false
                }
            },
            "Function": {
                "All": {
                    "Allow": true
                },
                "Admin": {
                    "Allow": false
                },
                "Tool": {
                    "Allow": false
                }
            }
        }
    },
    "Admin": {
        "Name": "管理员",
        "Type": "Admin",
        "Color": "red",
        "Permission": {
            "All": {
                "Allow": true
            }
        }
    },
    "Monitor": {
        "Name": "班长",
        "Type": "Admin",
        "Color": "BlueViolet",
        "Include": "Admin"
    },
    "Teacher": {
        "Name": "教师",
        "Type": "Admin",
        "Color": "Coral",
        "Include": "Admin"
    },
    "Test": {
        "Name": "内测人员",
        "Type": "Admin",
        "Color": "Blue",
        "Permission": {
            "All": {
                "Allow": true
            },
            "Function": {
                "All": {
                    "Allow": true
                },
                "Admin": {
                    "Allow": false
                },
                "User": {
                    "Do": {
                        "Register": false
                    }
                }
            }
        }
    }
}
FlandreStudio_JSON;
?>