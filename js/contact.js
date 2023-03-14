const form = document.getElementById("contact-form");

form.addEventListener("submit", function(event) {
  event.preventDefault();
  
  const formData = new FormData(this);
  
  fetch("mailto:ypmzolisa@gmail.com", {
    method: "POST",
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    alert("Thank you for your message!");
    form.reset();
  })
  .catch(error => {
    console.error("There was a problem submitting the form: ", error);
  });
});
