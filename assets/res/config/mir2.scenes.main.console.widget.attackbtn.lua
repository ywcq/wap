local attackbtn = class("attackbtn", function ()
	return display.newNode()
end)
table.merge(attackbtn, {
	console
})

attackbtn.ctor = function (self, data, console)	
	data.x = data.x or display.width-100
	data.y = data.y or 100
    self.size(self, 200, 200):anchor(0.5, 0.5):pos(data.x, data.y)
	self:loadSpr()
	return 
end


attackbtn.loadSpr = function (self)

	if self.content then
		self.content:removeSelf()
	end
	
	self.content = display.newNode():addto(self):anchor(1,0)
	
	local attackpos = def.xiaolan.attack.attack or 1
	local playerpos = def.xiaolan.attack.player or 1
	local monpos = def.xiaolan.attack.mon or 1
	--print(attackpos,playerpos,monpos)
	if not g_data.setting.base.singleAttackEnable then
		
		self.attbtn = res.get2("pic/console/attack/attack.png"):anchor(0.5, 0.5):pos(200- 200*attackpos, 200*attackpos):add2(self.content)
		self.monbtn = res.get2("pic/console/attack/selmon.png"):anchor(0.5, 0):pos(200-200*monpos, 0):add2(self.content)
		self.player = res.get2("pic/console/attack/selplayer.png"):anchor(1, 0.5):pos(200, 200*playerpos):add2(self.content)
		
	else
	--滑动所怪
	
		self.morenbg = res.get2("pic/console/attack/moren.png"):pos(200- 200*attackpos, 200*attackpos):addto(self.content)
		self.attckbtn = res.get2("pic/console/attack/attack.png"):pos(200- 200*attackpos, 200*attackpos):pos(200- 200*attackpos, 200*attackpos):addto(self.content,2)
		
		local data = g_data.player:getMagic(g_data.setting.job.autoSkill.magicId)
		--self.attckbtn:pos(200- 200*attackpos, 200*attackpos):addto(self.content,2)
	end

	return
end

attackbtn.attack = function (self)
	local lock = main_scene.ui.console.controller.lock
	if lock.target.skill then
		local role = main_scene.ground.map:findRole(lock.target.skill)

		if role then
			lock.stop(lock)
			lock.setAttackTarget(lock, role)

			return 
		end
	end

	if lock.target.select then
		local role = main_scene.ground.map:findRole(lock.target.select)
		if role then
			lock.setAttackTarget(lock, role)

			return 
		end
	end

	if lock.target.attack then
		local role = main_scene.ground.map:findRole(lock.target.select)
		if role and not role.die then
			return 
		else
			lock.setAttackTarget(lock)
		end
	end

	local role = main_scene.ground.map:findNearMon()

	if role then
		lock.setAttackTarget(lock, role)
	else
		lock.setAttackTarget(lock)
		main_scene.ui:tip("附近没有怪物.")
	end

	return 
end
attackbtn.selplayer = function (self, btn)
	if g_data.client:checkLastTime("selectplayer", 0.5) then
		g_data.client:setLastTime("selectplayer", true)
		
		if not btn.looks then
			btn.looks = {}
		end
		local roles = {}
		local mainPlayer = main_scene.ground.player
		local choose = nil
		local function someTextIsSame(src, des)
			for i = 1,#src do
				local t1 = src[i]
				local t2 = des[i]
				if t1 == t2 and #t1 > 0 then
					return true
				end
			end
		end
		for k, v in pairs(main_scene.ground.map.heros) do
			if not v.die and not v.isPlayer and not v.isDummy and not v.info:isHero() then
				if g_data.player.attackMode and type(g_data.player.attackMode) == "string" and (g_data.player.attackMode == "[全体攻击模式]" or g_data.player.attackMode == "[和平攻击模式]") then
					roles[#roles + 1] = v
				elseif not v.info.haveGuild then
					roles[#roles + 1] = v
				elseif v.info.guildName then
					if  mainPlayer.info.guildName then
						if mainPlayer.info.guildName ~= v.info.guildName then
							roles[#roles + 1] = v
						end
					end
				end
			end
		end

		table.sort(roles, function (a, b)
			return main_scene.ground.player:getDis(a) < main_scene.ground.player:getDis(b)
		end)
	--
		for i, v in ipairs(roles) do
			if not btn.looks[v.roleid] then
				btn.looks[v.roleid] = true
				choose = v
				break
			end
		end

		if not choose then
			btn.looks = {}
			if 0 < #roles then
				btn.looks[roles[1].roleid] = true
				choose = roles[1]
			end
		end

		local lock = main_scene.ui.console.controller.lock
		if lock.skill.enable then
			lock.skill = {}
			main_scene.ui.console.skills:select()
		end

		lock.stop(lock)
		if lock.target.skill then
			local role = main_scene.ground.map:findRole(lock.target.skill)
			if role then
				lock.setSelectTarget(lock, role)
				return 
			end
		end
				
		if choose then
			lock.setSelectTarget(lock, choose)				
			main_scene.ui:tip('锁定玩家：'..choose.info:getName())
			
		else
			main_scene.ui:tip("附近没有敌对.")
			lock.stop(lock)
		end
	else
		main_scene.ui:tip("你操作的太快了。")
	end

    return
end
attackbtn.slemon = function (self, btn)
	if g_data.client:checkLastTime("selectmon", 0.5) then
		g_data.client:setLastTime("selectmon", true)
		local mainPlayer = main_scene.ground.player
		local choose = nil
		if not btn.looks then
			btn.looks = {}
		end
		local pets = {}

		for k, v in pairs(main_scene.ground.map.mons) do
			if not v.die and not v.isPolice(v) and not v.isDummy and not v.isHaveMaster and v.info:getName():find(mainPlayer.info:getName()) == nil then
				table.insert(pets, v)
			end
		end

		table.sort(pets, function (a, b)
			return main_scene.ground.player:getDis(a) < main_scene.ground.player:getDis(b)
		end)

		for i, v in ipairs(pets) do
			if not btn.looks[v.roleid] then
				btn.looks[v.roleid] = true
				choose = v
				break
			end
		end

		if not choose then
			btn.looks = {}
			if 0 < #pets then
				btn.looks[pets[1].roleid] = true
				choose = pets[1]
			end
		end

		local lock = main_scene.ui.console.controller.lock
		if lock.skill.enable then
			lock.skill = {}
			main_scene.ui.console.skills:select()
		end
		
		lock.stop(lock)
		if lock.target.skill then
			local role = main_scene.ground.map:findRole(lock.target.skill)
			if role then
				lock.setSelectTarget(lock, role)
				return 
			end
		end		

		if choose then
			lock.setSelectTarget(lock, choose)
		else
			main_scene.ui:tip("附近没有怪物.")
			lock.stop(lock)
		end
	else
		main_scene.ui:tip("你操作的太快了。")
	end
	
    return
end
attackbtn.handleTouch = function (self, event)

	if not g_data.setting.base.singleAttackEnable then
		if event.name == "began" then
		
			g_data.setting.base.test111 = self.attbtn:getBoundingBox()
			if cc.rectContainsPoint(self.attbtn:getBoundingBox(), cc.p(event.x-self:getPositionX()+100,event.y-self:getPositionY()+100)) then
				self:attack()
				self.attbtn:setTex(res.gettex2("pic/console/attack/attack-on.png"))
			end
			if cc.rectContainsPoint(self.monbtn:getBoundingBox(), cc.p(event.x-self:getPositionX()+100,event.y-self:getPositionY()+100)) then
				self:slemon(btn)
				self.monbtn:setTex(res.gettex2("pic/console/attack/selmon-on.png"))
			end
			if cc.rectContainsPoint(self.player:getBoundingBox(), cc.p(event.x-self:getPositionX()+100,event.y-self:getPositionY()+100)) then
				self:selplayer(btn)
				self.player:setTex(res.gettex2("pic/console/attack/selplayer-on.png"))
			end
		elseif (event.name == "ended" or event.name == "cancelled") then
			self.attbtn:setTex(res.gettex2("pic/console/attack/attack.png"))
			self.monbtn:setTex(res.gettex2("pic/console/attack/selmon.png"))
			self.player:setTex(res.gettex2("pic/console/attack/selplayer.png"))
		end
		return
	
	else
		local y = event.y - self:getPositionY()-self.attckbtn:getPositionY()+100
		local btnsize = self.attckbtn:geth()/2
		if event.name == "began" then
			self.attckbtn:setTex(res.gettex2("pic/console/attack/attack-on.png"))
		elseif event.name == "moved" then
			--print(y,btnsize)
			if y > btnsize  then
				self.morenbg:setTex(res.gettex2("pic/console/attack/selplayer-on1.png"))
			elseif y < -btnsize then
				self.morenbg:setTex(res.gettex2("pic/console/attack/selmon-on1.png"))
			end
		elseif (event.name == "ended" or event.name == "cancelled") then
			self.morenbg:setTex(res.gettex2("pic/console/attack/moren.png"))
			if y > btnsize  then
				--print("玩家选择")
				self:selplayer(btn)
			elseif y < -btnsize then
				--print("怪物选择")
				self:slemon(btn)
			else
				--print("普通攻击")
				--print("挂机技能id",g_data.setting.job.autoSkill.magicId)
				--main_scene.ui.console.btnCallbacks:handle("skill", g_data.setting.job.autoSkill.magicId, data)
				self:attack()
			end
			self.attckbtn:setTex(res.gettex2("pic/console/attack/attack.png"))
		end
	end

	return 
end
return attackbtn
