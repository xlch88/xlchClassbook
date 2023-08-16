<?php
return <<<FlandreStudio_JSON
[
    {
        "GroupId": "MyInfo",
        "GroupName": "我的资料",
        "Icon": "address-book",
        "Key": [
            {
                "Id": "Birthday",
                "Name": "生日",
                "Icon": "birthday-cake",
                "Type": "Date",
                "Preg": ""
            },
            {
                "Id": "Gender",
                "Name": "性别",
                "Icon": "transgender",
                "Type": "Radio",
                "Option": [
                    "汉子",
                    "妹子",
                    "TS/Other",
                    "武装直升机"
                ]
            },
            {
                "Id": "Motto",
                "Name": "座右铭",
                "Icon": "leaf",
                "Type": "Text",
                "Preg": "",
                "MaxLength": 50,
                "MinLength": 5
            },
            {
                "Id": "Constellation",
                "Name": "星座",
                "Icon": "star",
                "Type": "Select",
                "Option": [
                    "白羊座",
                    "金牛座",
                    "双子座",
                    "巨蟹座",
                    "狮子座",
                    "处女座",
                    "天枰座",
                    "天蝎座",
                    "射手座",
                    "摩羯座",
                    "水瓶座",
                    "双鱼座"
                ]
            },
            {
                "Id": "Weight",
                "Name": "体重",
                "Icon": "balance-scale",
                "Type": "Number",
                "Preg": "",
                "Footer": "kg",
                "SetWatcher": true,
                "MaxLength": 3,
                "MinLength": 1
            },
            {
                "Id": "Height",
                "Name": "身高",
                "Icon": "tree",
                "Type": "Number",
                "Preg": "",
                "Footer": "cm",
                "SetWatcher": true,
                "MaxLength": 3,
                "MinLength": 1
            },
            {
                "Id": "Character",
                "Name": "性格",
                "Icon": "sun-o",
                "Type": "Check",
                "Option": [
                    "外向",
                    "善良",
                    "开朗",
                    "活泼",
                    "好动",
                    "轻松",
                    "愉快",
                    "热情",
                    "可亲",
                    "豁达",
                    "稳重",
                    "幽默",
                    "真诚",
                    "豪爽",
                    "耿直",
                    "成熟",
                    "独立",
                    "果断",
                    "健谈",
                    "机敏",
                    "深沉",
                    "坚强",
                    "兴奋",
                    "率直",
                    "毅力",
                    "友爱",
                    "风趣",
                    "沉静",
                    "谨慎",
                    "忠诚",
                    "友善",
                    "严肃",
                    "忠心",
                    "乐观",
                    "坦率",
                    "勇敢",
                    "自信",
                    "自立",
                    "沉著",
                    "执著",
                    "容忍",
                    "体贴",
                    "满足",
                    "积极",
                    "有趣",
                    "知足",
                    "勤劳",
                    "和气",
                    "无畏",
                    "务实",
                    "轻浮",
                    "冲动",
                    "幼稚",
                    "自私",
                    "依赖",
                    "任性",
                    "自负",
                    "拜金",
                    "暴躁",
                    "倔强",
                    "虚伪",
                    "孤僻",
                    "刻薄",
                    "武断",
                    "浮躁",
                    "莽撞",
                    "易怒",
                    "轻率",
                    "善变",
                    "狡猾",
                    "多疑",
                    "懒惰",
                    "专横",
                    "顽固",
                    "猜疑",
                    "挑衅",
                    "冷漠",
                    "虚荣",
                    "冷淡",
                    "反覆",
                    "跋扈",
                    "逆反",
                    "怨恨",
                    "鲁莽",
                    "放任",
                    "贫乏",
                    "固执",
                    "内向",
                    "脆弱",
                    "自卑",
                    "害羞",
                    "敏感",
                    "迟钝",
                    "柔弱",
                    "畏缩",
                    "顺从",
                    "胆小",
                    "安静",
                    "寡言",
                    "保守",
                    "被动",
                    "忍让",
                    "抑郁",
                    "胆怯",
                    "温和",
                    "老实",
                    "平和",
                    "顺服",
                    "含蓄",
                    "迁就",
                    "羞涩",
                    "忸怩",
                    "缓慢",
                    "乏味",
                    "散漫",
                    "迟缓",
                    "罗嗦",
                    "耐性",
                    "悲观",
                    "消极",
                    "拖延",
                    "烦躁",
                    "妥协",
                    "唠叨"
                ]
            }
        ]
    },
    {
        "GroupId": "SocialAccount",
        "GroupName": "社交账号",
        "Icon": "qq",
        "Key": [
            {
                "Id": "QQ",
                "Name": "QQ",
                "Icon": "qq",
                "Type": "Number",
                "Preg": "\/^[1-9][0-9]{4,}$\/",
                "SetWatcher": true,
                "MaxLength": 11,
                "MinLength": 5
            },
            {
                "Id": "Weibo",
                "Name": "微博",
                "Icon": "weibo",
                "Type": "Text",
                "Preg": "",
                "SetWatcher": true,
                "MaxLength": 20,
                "MinLength": 0
            },
            {
                "Id": "WeChat",
                "Name": "微信",
                "Icon": "wechat",
                "Type": "Text",
                "Preg": "",
                "SetWatcher": true,
                "MaxLength": 20,
                "MinLength": 0
            }
        ]
    },
    {
        "GroupId": "LikeAndDislike",
        "GroupName": "我的喜好",
        "Icon": "heart",
        "Key": [
            {
                "Id": "MyLikeThing",
                "Name": "我喜欢的事情",
                "Icon": "heart",
                "Type": "Text",
                "Preg": "",
                "SetWatcher": true,
                "MaxLength": 200,
                "MinLength": 0
            },
            {
                "Id": "MyDislikeThing",
                "Name": "我讨厌的事情",
                "Icon": "heart-o",
                "Type": "Text",
                "Preg": "",
                "SetWatcher": true,
                "MaxLength": 200,
                "MinLength": 0
            },
            {
                "Id": "MyLikeItem",
                "Name": "我喜欢的东西",
                "Icon": "heart",
                "Type": "Text",
                "Preg": "",
                "SetWatcher": true,
                "MaxLength": 200,
                "MinLength": 0
            },
            {
                "Id": "MyDislikeItem",
                "Name": "我讨厌的东西",
                "Icon": "heart-o",
                "Type": "Text",
                "Preg": "",
                "SetWatcher": true,
                "MaxLength": 200,
                "MinLength": 0
            },
            {
                "Id": "BeGoodAt",
                "Name": "我擅长做的事",
                "Icon": "heart-o",
                "Type": "Text",
                "Preg": "",
                "SetWatcher": true,
                "MaxLength": 200,
                "MinLength": 0
            }
        ]
    },
    {
        "GroupId": "Location",
        "GroupName": "我的地址",
        "Icon": "",
        "Key": [
            {
                "Id": "Hometown",
                "Name": "故乡",
                "Icon": "home",
                "Type": "Text",
                "Preg": "",
                "SetWatcher": true,
                "MaxLength": 30,
                "MinLength": 4
            },
            {
                "Id": "NowLive",
                "Name": "现在居住在",
                "Icon": "hotel",
                "Type": "Text",
                "Preg": "",
                "SetWatcher": true,
                "MaxLength": 30,
                "MinLength": 4
            },
            {
                "Id": "ZipCode",
                "Name": "邮政编码",
                "Icon": "bell",
                "Type": "Text",
                "Preg": "\/^[0-9]{6}$\/",
                "SetWatcher": true
            }
        ]
    },
    {
        "GroupId": "ContactMe",
        "GroupName": "联系我",
        "Icon": "",
        "Key": [
            {
                "Id": "Phone",
                "Name": "手机",
                "Icon": "phone",
                "Type": "Text",
                "Preg": "phone",
                "SetWatcher": true
            },
            {
                "Id": "Email",
                "Name": "邮箱",
                "Icon": "envelope",
                "Type": "Text",
                "Preg": "emailAddress",
                "SetWatcher": true
            }
        ]
    }
]
FlandreStudio_JSON;
?>
