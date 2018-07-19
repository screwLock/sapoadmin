function validPhoneNumber(phoneNumber){
    var rePhoneNumber = /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/;
    return rePhoneNumber.test(phoneNumber);
}