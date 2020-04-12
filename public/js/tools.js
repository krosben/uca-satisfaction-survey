export function disableFieldsById(fields, relatedId) {
  const relatedField = document.getElementById(relatedId).value;
  fields.forEach(field => {
    field.disabled = !relatedField ? true : false;
  });
}

export function hideOptionsFromSelectByData(selector, selectId, datasetSuffix, disableFields) {
  return function (event) {
    event.preventDefault();
    disableFieldsById(disableFields, selectId);
    const selects = document.querySelectorAll(selector);
    selects.forEach(select => {
      const { options } = select;
      for (let index = 1; index < options.length; ++index) {
        options[index].hidden = false;
        if (options[index].dataset[datasetSuffix] !== event.target.value) {
          options[index].hidden = true;
        }
      }
    })
  }
}