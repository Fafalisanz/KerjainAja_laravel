function nextStep(nextId, currentId) {
  document.getElementById(currentId).classList.remove("active");
  document.getElementById(nextId).classList.add("active");
}

function prevStep(prevId, currentId) {
  document.getElementById(currentId).classList.remove("active");
  document.getElementById(prevId).classList.add("active");
}
