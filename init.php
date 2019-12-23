<?
//событие проверяющее поле телефон,e-mail и логин на уникальность.
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterHandler");
function OnBeforeUserRegisterHandler($args)
{
	GLOBAL $APPLICATION;

	$filter = Array('PERSONAL_PHONE' => $args['PERSONAL_PHONE']);
	$rsUsersPhone = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
	if($arUserPhone = $rsUsersPhone->Fetch()){
		$err = true;

		//$e = new CAdminException();
		$e=false;
		$e.='Пользователь с телефоном "'.$args['PERSONAL_PHONE']. '" уже существует.<br />';

		$filter = Array('LOGIN' => $args['LOGIN']);
		$rsUsersName = CUser::GetList(($by = "NAME"), ($order = "desc"), $filter);
		if($arUserName = $rsUsersName -> Fetch()){
			$e.='Пользователь с логином "'.$args['LOGIN']. '" уже существует.<br />';
		}

		$filter = Array('EMAIL' => $args['EMAIL']);
		$rsUsersMail = CUser::GetList(($by = "EMAIL"), ($order = "desc"), $filter);
		if($arUserMail = $rsUsersMail -> Fetch()){
			$e.='Пользователь с таким e-mail ('.$args['EMAIL']. ') уже существует.<br />';
		}

		$APPLICATION->ThrowException($e);

		return false; 
	}
	return true;
}

?>