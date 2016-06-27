

function checkClearanceForm()
{
	with (window.document.frmAddReservation) {
		 if (isEmpty(txtStaff, 'Enter the name of the Staff')) {
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

function deleteImage(productId)
{
	if (confirm('Delete this image')) {
		window.location.href = 'processEquipment.php?action=deleteImage&productId=' + productId;
	}
}