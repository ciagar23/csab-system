// JavaScript Document
function viewReservation(productId)
{
	with (window.document.frmListReservation) {
		if (cboCategory.selectedIndex == 0) {
			window.location.href = 'index.php?productId=' + productId;
		} else {
			window.location.href = 'index.php?productId=' + productId + '&catId=' + cboCategory.options[cboCategory.selectedIndex].value;
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

function deleteReservation(productId, catId)
{
	if (confirm('Delete this equipment?')) {
		window.location.href = 'processEquipment.php?action=deleteReservation&productId=' + productId + '&catId=' + catId;
	}
}
function deleteBorrowed(productId, equipId)
{
	if (confirm('Remove this?')) {
		window.location.href = 'processReservation.php?action=deleteBorrowed&productId=' + productId + '&equipId=' + equipId;
	}
}

function addBorrowed(productId, pd_id, bm, bd, by)
{
	if (confirm('Add this to reservation List?')) {
		window.location.href = 'processReservation.php?action=addBorrowed&productId=' + productId + '&equipId=' + pd_id + '&bm=' + bm + '&bd=' + bd + '&by=' + by;
	}
}

function deleteImage(productId)
{
	if (confirm('Delete this image')) {
		window.location.href = 'processEquipment.php?action=deleteImage&productId=' + productId;
	}
}