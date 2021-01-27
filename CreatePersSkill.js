var asset = {
  model: document.getElementById('AssetModel'),
  supplier: document.getElementById('AssetSupplier'),
  type: document.getElementById('AssetType'),
  price: document.getElementById('AssetPrice'),
  serial: document.getElementById('AssetSerial'),
  os: document.getElementById('Operating System'),
  status: document.getElementById('AssetStatus'),
  note: document.getElementById('AssetNote'),
  submit: document.getElementById('btn-submit')
};

asset.submit.addEventListener('click', () => {
  const request = new XMLHttpRequest();

  request.onload = () => {
    let responseObject = null;

    try {
      responseObject = JSON.parse(request.responseText);
    } catch (error) {
      console.error('Could not parse JSON');
    }
    if (responseObject) {
      handleResponse(responseObject);
    }
  };
  const requestData = `AssetModel=${asset.model.value}&AssetType=${asset.type.value}&AssetSupplier=${asset.supplier.value}&AssetOS=${asset.os.value}&AssetPrice=${asset.price.value}&AssetSerial=${asset.serial.value}&AssetStatus=${asset.status.value}&AssetNote=${asset.note.value}`;

  request.open('POST', 'CreateAsset.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send(requestData);
});

function handleResponse(responseObject) {
  if (responseObject.ok) {
    modal.style.display = 'none';
    alert.relocate = 'AssetLink.php?%20id=A' + responseObject.tag;
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
  } else {
    modal.style.display = 'none';
    alert.refresh = false;
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
  }
}
