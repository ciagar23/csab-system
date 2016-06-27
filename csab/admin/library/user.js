// JavaScript Document
function checkAddUserForm()
{
	with (window.document.frmAddUser) {
		if (isEmpty(txtFName, 'Enter First Name')) {
			return;
		} else if (isEmpty(txtLName, 'Enter Lastname')) {
			return;
		} else if (isEmpty(txtUserName, 'Enter Username')) {
			return;
		} else if (isEmpty(txtPassword, 'Enter Password')) {
			return;
		} else if (isEmpty(txtPosition, 'Select Position')) {
			return;
		} else {
			submit();
		}
	}
}

function checkPassword()
{
	with (window.document.frmAddUser) {
		if (isEmpty(txtPassword, 'Enter First Password')) {
			return;
		} else if (isEmpty(txtPassword2, 'Repeat Password')) {
			return;
		} else {
			submit();
		}
	}
}

function addUser()
{
	window.location.href = 'index.php?view=add';
}

function changePassword(userId)
{
	window.location.href = 'index.php?view=modify&userId=' + userId;
}

function deleteUser(userId)
{
	if (confirm('Delete this user?')) {
		window.location.href = 'processUser.php?action=delete&userId=' + userId;
	}
}

