// JavaScript Document
function viewProduct()
{
	with (window.document.frmListProduct) {
		if (cboCategory.selectedIndex == 0) {
			window.location.href = 'index.php';
		} else {
			window.location.href = 'index.php?catId=' + cboCategory.options[cboCategory.selectedIndex].value;
		}
	}
}

function checkAddProductForm()
{
	with (window.document.frmAddProduct) {
		if (cboCategory.selectedIndex == 0) {
			alert('Choose the Item category');
			cboCategory.focus();
			return;
		} else if (isEmpty(txtName, 'Enter Item name')) {
			return;
		} else if (isEmpty(txtCode, 'Enter Item Code')) {
			return;
		} else {
			submit();
		}
	}
}

function addProduct(catId)
{
	window.location.href = 'index.php?view=add&catId=' + catId;
}

function modifyProduct(productId)
{
	window.location.href = 'index.php?view=modify&productId=' + productId;
}

function deleteProduct(productId, catId)
{
	if (confirm('Delete this equipment?')) {
		window.location.href = 'processEquipment.php?action=deleteProduct&productId=' + productId + '&catId=' + catId;
	}
}

function deleteImage(productId)
{
	if (confirm('Delete this image')) {
		window.location.href = 'processEquipment.php?action=deleteImage&productId=' + productId;
	}
}