local c = require "config.application"

local m = {serverlist = ''}
local function reload()
	-- os.execute([[cd > D:\\a.tmp]])  win默认路径是C:\Windows\system32

	-- local f = io.open("/usr/local/logincenter/config/serverlist.json", "r")
	local f = assert(io.open(ngx.var.realpath_root .. "/../config/serverlist.json", "r"))
	--local f = io.open("../logincenter_win/config/serverlist.json", "r")
	m.serverlist = f:read("*a")
	f:close()
end

function m.init()
	reload()
end

function m.post(s)
end

function m.get(s)
	return '{
	
	
	
	
	
{
    "serverlist": {
        "kaifubiao": 1,
        "servers": [{
            "isactive": 1,
            "serverid": "1997dw",
            "rank1": 1,
            "rank2": 1,
            "serverip": "8.134.175.182:88",
            "servername": "游蚊苍穹录",
            "desc": " 火爆开区中"
        }],
        "imglist": [{
            "pos": "1",
            "url": "http://8.134.175.182:88/gg/1.png"
        }, {
            "pos": "2",
            "url": "http://8.134.175.182:88/gg/2.png"
        }, {
            "pos": "3",
            "url": "http://8.134.175.182:88/gg/3.png"
        }],
        "notice": "<b><param size=25 textcolor=255|0|0  /><t \r\n                                    游蚊苍穹录\r\n /></b><b><param size=20 textcolor=255|222|173 /><t \r\n十年旧梦，重温昔日情怀，满腔热血，邀您续写当年传奇！\r\n 苹果-安卓-电脑，三端互通！100%还原！经典再现！\r\n独家全新版本｜特色功能｜装备保值｜一切靠打！\r\n 元宝比例1:10，玩家交流QQ群:859704091 \r\n每月稳定开放一个新区 首次攻占《沙巴克》奖励丰富，具体游戏查看体验！ \r\n /></b><b><param size=25 textcolor=120|210|0/><t \r\n 　 开区时间：2024年6月8号14：00\r\n 　  /></b>"
    }
}





}'
end

reload()

return m
