function addInputFields() {
  const columnCount = document.querySelector('input[name="count"]').value;
  const inputFieldsContainer = document.getElementById("inputFields");

  // Clear any existing input fields
  inputFieldsContainer.innerHTML = "";

  for (let i = 0; i < columnCount; i++) {
    const inputField = document.createElement("input");

    inputField.type = "text"; // You can change the input type as needed
    inputField.name = "column" + (i + 1); // Generate unique names for each input field
    inputField.setAttribute("required", "required");
    inputFieldsContainer.appendChild(inputField);
    inputFieldsContainer.appendChild(document.createElement("br"));

    inputField.onchange = () => {
      // check at frontend
      if (checkKeywords(inputField.value.toLowerCase())) {
        if (inputField.value.toLowerCase().includes("firstname")) {
          inputField.value = "firstName";
        }
        else if (inputField.value.toLowerCase().includes("lastname")) {
          inputField.value = "lastName";
        }
        else if (inputField.value.toLowerCase().includes("ph")) {
          inputField.value = "phoneNumber";
        }
        else if (inputField.value.toLowerCase().includes("mail")) {
          inputField.value = "email";
        }
        else if (inputField.value.toLowerCase().includes("pass")) {
          inputField.value = "password";
        }
        else if (inputField.value.toLowerCase().includes("num")) {
          inputField.value = "number";
        }
        else if (inputField.value.toLowerCase().includes("qty")) {
          inputField.value = "quantity";
        }
        else if (inputField.value.toLowerCase().includes("bankacc")) {
          inputField.value = "bankAccountNumber";
        }
        else if (inputField.value.toLowerCase().includes("des")) {
          inputField.value = "description";
        }
        else {
          // change for valid values of keywords only
          inputField.value = inputField.value.toLowerCase();
        }
      } else {
        // unvalid values 
        alert("Not valid text.");
        inputField.value = "";
        inputField.focus();
      }
    };
  }
}
function checkKeywords(keyword) {
  const keywords = [
    "name",
    "firstName",
    "firstname",
    "lastName",
    "lastname",
    "email",
    "mail",
    "password",
    "pass",
    "phone",
    "ph", "phoneno",
    "address",
    "startdate",
    "enddate",
    "quantity", "qty",
    "number", "num",
    "price",
    "bankacc",
    "gender",
    "company",
    "city",
    "age",
    "country",
    "state",
    "description", "des",
  ];
  return keywords.includes(keyword.toLowerCase());
}
