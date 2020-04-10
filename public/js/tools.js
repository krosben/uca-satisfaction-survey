function disableFieldsById(fields, relatedId) {
  const relatedField = document.getElementById(relatedId).value;
  fields.forEach(field => {
    field.disabled = relatedField === "" ? true : false;
  });
}

function filterSubjects(e) {
  e.preventDefault();

  const degree = this.value;
  const subjects = document.getElementById("subject-id");
  const groups = document.getElementById("group-id");

  disableFieldsById([subjects, groups], 'degree-id');

  const options = subjects.options;
  for (let i = 1; i < options.length; i++) {
    options[i].hidden = false;
    options[i].dataset.idDegree !== degree ? options[i].hidden = true : null;
  }
}

function filterProffesor(e) {
  e.preventDefault();

  const subjectId = this.value
  const proffesor = document.querySelectorAll('[name^="proffesors["]');

  disableFieldsById(proffesor, 'subject-id');

  proffesor.forEach(p => {
    const options = p.options;
    for (let i = 0; i < options.length; i++) {
      options[i].hidden = false;
      options[i].dataset.idSubject !== subjectId ? options[i].hidden = true : null;
    }
  })

}

disableFieldsById([
  document.getElementById("subject-id"),
  document.getElementById("group-id")
], 'degree-id')


disableFieldsById(document.querySelectorAll('[name^="proffesors["]'), 'subject-id')

document.getElementById("degree-id").addEventListener("change", () => {
  document.getElementById("subject-id").selectedIndex = 0;
});

document.getElementById("subject-id").addEventListener("change", () => {
  document.querySelectorAll('[name^="proffesors["]').forEach(p => {
    p.selectedIndex = 0;
  });
});

document.getElementById("degree-id").addEventListener("change", filterSubjects);
document.getElementById("subject-id").addEventListener("change", filterProffesor);