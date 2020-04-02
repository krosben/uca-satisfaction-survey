document.getElementById("subject-id").disabled = true;
document.getElementById("group-id").disabled = true;

function filterSubjects(e) {
  e.preventDefault();
  const degree = this.value;
  const subjects = document.getElementById("subject-id");
  const groups = document.getElementById("group-id");
  subjects.selectedIndex = 0;

  if (subjects.disabled) {
    subjects.disabled = false;
    groups.disabled = false;
  }

  const options = subjects.options;
  for (let i = 1; i < options.length; i++) {
    options[i].hidden = false;
    options[i].dataset.idDegree !== degree ? options[i].hidden = true : null;
  }
}

document.getElementById("degree-id").addEventListener("change", filterSubjects);
