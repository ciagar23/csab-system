// JavaScript Document
function viewReservation()
{
	with (window.document.frmListReservation) {
		if (cboCategory.selectedIndex == 0) {
			window.location.href = 'index.php';
		} else {
			window.location.href = 'index.php?catId=' + cboCategory.options[cboCategory.selectedIndex].value;
		}
	}
}




function checkAddReservationForm()
{
	with (window.document.frmAddReservation) {
		 if (isEmpty(txtRoomNo, 'Enter Room / Equipment Number')) {
			return;
		} else if (isEmpty(txtClass, 'Enter Class')) {
			return;
		} else if (isEmpty(txtSubject, 'Enter Subject')) {
			return;
		} else if (isEmpty(txtBy, 'Please Complete The Date')) {
			return;
		} else if (isEmpty(txtBm, 'Please Complete The Date')) {
			return;
		} else if (isEmpty(txtBd, 'Please Complete The Date')) {
			return;
		} else if (isEmpty(txtRy, 'Please Complete The Date')) {
			return;
		} else if (isEmpty(txtRm, 'Please Complete The Date')) {
			return;
		} else if (isEmpty(txtRd, 'Please Complete The Date')) {
			return;
		} else if (isEmpty(txtBh, 'Please Complete The Time')) {
			return;
		} else if (isEmpty(txtBmi, 'Please Complete The Time')) {
			return;
		} else if (isEmpty(txtRh, 'Please Complete The Time')) {
			return;
		} else if (isEmpty(txtRmi, 'Please Complete The Time')) {
			return;
		} else {
			submit();
		}
	}
}

function addReservation(catId)
{
	window.location.href = 'index.php?view=add&catId=' + catId;
}

function modifyReservation(productId)
{
	window.location.href = 'index.php?view=reserve&productId=' + productId;
}

function confirmDean(productId)
{
	if (confirm('Dean: Approve the Reservation?')) {
		window.location.href = 'processConfirmation.php?action=confirmDean&productId=' + productId;
	}
}
function confirmPresident(productId)
{
	if (confirm('President: Approve the Reservation?')) {
		window.location.href = 'processConfirmation.php?action=confirmPresident&productId=' + productId;
	}
}
function confirmIMC(productId)
{
	if (confirm('IMC: Approve the Reservation?')) {
		window.location.href = 'processConfirmation.php?action=confirmIMC&productId=' + productId;
	}
}

function confirmGSO(productId, eid)
{
	if (confirm('GSO: Approve the Reservation?\n Please check the Approval of the Dean,\n the President and IMC first')) {
		window.location.href = 'processConfirmation.php?action=confirmGSO&productId=' + productId + '&eId=' + eid;
	}
}


function sorryDean(productId, eid)
{
	if (confirm('Please Wait for the Approval of the Dean')) {
		return
	}
}


function sorryIMC(productId, eid)
{
	if (confirm('Please Wait for the Approval of IMC')) {
		return
	}
}


function sorryPresident(productId, eid)
{
	if (confirm('Please Wait for the Approval of the President')) {
		return
	}
}

function disapprove(productId, eid)
{
 var Reason = prompt("Reason of Disapproval: ", " ");
 window.location.href = 'processConfirmation.php?action=disapprove&productId=' + productId + '&eId=' + eid + '&reason=' + Reason;
}


function deleteImage(productId)
{
	if (confirm('Delete this image')) {
		window.location.href = 'processEquipment.php?action=deleteImage&productId=' + productId;
	}
}