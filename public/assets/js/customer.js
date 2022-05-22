document.getElementById('duplicate').onclick = duplicate;


var i = 0;
var original = document.getElementById('duplicater');
var duplicates = document.getElementById('duplicates');

function duplicate() {
    var clone = original.cloneNode(true); 
    clone.id = "new_address_" + ++i;
    clone.getElementsByTagName('td')[0].innerHTML = `Address ${i+1} <button type="button" class="btn btn-danger btn-sm float-end" onclick="remove(${i})">Remove</button>`;
    duplicates.appendChild(clone);
}

function remove(id) {
    var elementRemove = document.getElementById(`new_address_${id}`);
    elementRemove.parentNode.removeChild(elementRemove);
}