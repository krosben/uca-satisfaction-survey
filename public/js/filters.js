import { disableFieldsById, hideOptionsFromSelectByData } from './tools.js';

window.addEventListener("load", () => {
  disableFieldsById([
    document.getElementById("subject-id"),
    document.getElementById("group-id")
  ], 'degree-id')


  disableFieldsById(document.querySelectorAll('[name^="proffesors["]'), 'subject-id')
})

document.getElementById("degree-id").addEventListener("change", () => {
  document.getElementById("subject-id").selectedIndex = 0;
});

document.getElementById("subject-id").addEventListener("change", () => {
  document.querySelectorAll('[name^="proffesors["]').forEach(p => {
    p.selectedIndex = 0;
  });
});

document.getElementById("degree-id").addEventListener(
  "change",
  hideOptionsFromSelectByData('#subject-id', 'degree-id', 'idDegree', ['#subject-id', '#group-id'].map(field => document.querySelector(field)))
);

document.getElementById("subject-id").addEventListener(
  "change",
  hideOptionsFromSelectByData('[name^="proffesors["]', 'subject-id', 'idSubject', document.querySelectorAll('[name^="proffesors["]'))
);
