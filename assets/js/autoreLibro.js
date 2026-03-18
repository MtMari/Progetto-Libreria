document
  .querySelectorAll('.add_item_link')
  .forEach(btn => {
      btn.addEventListener("click", addFormToCollection)
    });

document
    .querySelectorAll('div[id^="libro_autoreLibros_"]')
    .forEach((autore) => {
        document.querySelector('div.mb-3').setAttribute('class', 'mb-0');
        addAutoreFormDeleteLink(autore)
    });


function addFormToCollection(e) {

  const collectionHolder = document.querySelector('#' + e.currentTarget.dataset.collectionHolderId);
  
  const item = document.createElement('div');

  item.innerHTML = collectionHolder
    .dataset
    .prototype
    .replace(
      /__name__/g,
      collectionHolder.dataset.index
  );
  collectionHolder.appendChild(item);
  collectionHolder.dataset.index++;
  addAutoreFormDeleteLink(item);
}

function addAutoreFormDeleteLink(item) {

  const removeFormButton = document.createElement('button');
  removeFormButton.innerText = 'Elimina';

  item.querySelector('label').remove();
  removeFormButton.classList.add("btn", "btn-outline-danger", "btn-sm", "in-linea", "ms-3");
  item.querySelector('select').classList.add('in-linea', 'w-75', 'mt-3');

  item.querySelector('select').after(removeFormButton);

  removeFormButton.addEventListener('click', (e) => {
    e.preventDefault();
    item.remove();
  });
}