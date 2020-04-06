function filterSubjects(e) {
  e.preventDefault();
  const degree = this.value;
  const subjects = document.getElementById("subject-id");
  const groups = document.getElementById("group-id");

  if (subjects.value === "") {
    subjects.selectedIndex = 0;
  }

  subjects.disabled = subjects.value ? false : true;
  groups.disabled = groups.value ? false : true;

  const options = subjects.options;
  for (let i = 1; i < options.length; i++) {
    options[i].hidden = false;
    options[i].dataset.idDegree !== degree ? options[i].hidden = true : null;
  }
}

document.getElementById("degree-id").addEventListener("change", filterSubjects);
