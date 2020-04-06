function disableFields(fields) {
  const degree = document.getElementById("degree-id").value;
  fields.forEach(field => {
    field.disabled = degree === "" ? true : false;
  });
}

function filterSubjects(e) {
  e.preventDefault();

  const degree = this.value;
  const subjects = document.getElementById("subject-id");
  const groups = document.getElementById("group-id");

  disableFields([subjects, groups]);

  const options = subjects.options;
  for (let i = 1; i < options.length; i++) {
    options[i].hidden = false;
    options[i].dataset.idDegree !== degree ? options[i].hidden = true : null;
  }
}

disableFields([
  document.getElementById("subject-id"),
  document.getElementById("group-id")
])

document.getElementById("degree-id").addEventListener("change", () => {
  document.getElementById("subject-id").selectedIndex = 0;
});

document.getElementById("degree-id").addEventListener("change", filterSubjects);
