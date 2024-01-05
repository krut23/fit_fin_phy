// Live validation
// https://developer.tizen.org/community/tip-tech/using-livevalidation-javascript-library


// allow only one space in string (processed string)
function oneSpace(vstring){
    return [1,"String Processed...",vstring.replace(/\s+/g, " ")];
}

// not allow any space in string (processed string)
function noSpace(vstring){
    return [1,"String Processed...",vstring.replace(/\s+/g, "")];
}

// allow given length string (processed string)
function maxLength(vstring,slen){
    if(vstring.length>slen){
         return [0,"String Processed...",vstring.substr(0,slen)];
    }else{
        return [1,"String Processed...",vstring];
    }
}

// check minimum length (0,1)
function minLength(vstring,slen){
        if(vstring.length>=slen){
            return [1,"String Processed...",vstring];
        }else{
            return [0,"String Processed...",vstring];
        }
}

// allow only number in string (processed string)
function onlyNumbers(vstring){
    var processed = "";
    for (i = 0; i < vstring.length; i++) {
        if(/[0-9]/.test(vstring[i])){
            processed +=vstring[i];
        }
    }
    return [1,"String Processed...",processed];
}
// allow only char - _  ([0,1],[processed string])
function onlyCharacters(vstring,pett="",change=1){
    if(pett == "_"){
        var pattern = /^[A-Za-z\s_]+$/;
        var patt = /[a-zA-Z\s_]/;
    }else if(pett == "-"){
         var pattern = /^[A-Za-z\s-]+$/;
         var patt = /[a-zA-Z\s-]/;
    }else if(pett == "-_" || pett == "_-"){
         var pattern = /^[A-Za-z\s-_]+$/;
         var patt = /[a-zA-Z\s-_]/;
    }else {
        var pattern = /^[A-Za-z\s]+$/;
        var patt = /[a-zA-Z\s]/;
    }

    if(change){
        if(pattern.test(vstring)){
            return [1,"String Processed...",vstring];
        }else{
            var processed = "";
            for (var i = 0; i < vstring.length; i++) {
                if(patt.test(vstring[i])){
                    // console.log(vstring[i]);
                    processed +=vstring[i];
                }
            }
            return [1,"String Processed...",processed];
        }
    }else{
        if(pattern.test(vstring)){
            return [1,"String Processed...",vstring];
        }else{
            return [0,"String not Processed...",vstring];
        }
    }
}

// allow only char num - _  ([0,1],[processed string])
function onlyCharactersNum(vstring,pett="",change=1){
    if(pett == "_"){
        var pattern = /^[A-Za-z0-9\s_]+$/;
        var patt = /[a-zA-Z0-9\s_]/;
    }else if(pett == "-"){
         var pattern = /^[A-Za-z0-9\s-]+$/;
         var patt = /[a-zA-Z0-9\s-]/;
    }else if(pett == "-_" || pett == "_-"){
         var pattern = /^[A-Za-z0-9\s-_]+$/;
         var patt = /[a-zA-Z0-9\s-_]/;
    }else {
        var pattern = /^[A-Za-z0-9\s]+$/;
        var patt = /[a-zA-Z0-9\s]/;
    }

    if(change){
        if(pattern.test(vstring)){
            return [1,"String Processed...",vstring];
        }else{
            var processed = "";
            for (var i = 0; i < vstring.length; i++) {
                if(patt.test(vstring[i])){
                    // console.log(vstring[i]);
                    processed +=vstring[i];
                }
            }
            return [1,"String Processed...",processed];
        }
    }else{
        if(pattern.test(vstring)){
            return [1,"String Processed...",vstring];
        }else{
            return [0,"String not Processed...",vstring];
        }
    }
}

//////////////////////////////////////////////////////////////
//  Full function
//////////////////////////////////////////////////////////////

function checkName(vstring,min=0,max){
    var valid = 0;
    vstring = oneSpace(vstring)[2];
    valid =  minLength(vstring,min)[0];
    vstring = maxLength(vstring,max)[2];
    if (valid) {
        return [1,"Name is valid...",vstring];
    }else{
        return [0,"Name between "+min+" and "+max+" characters...",vstring];
    }
}

function checkUsername(vstring,min=0,max=25,pett="",change=1){
    var valid = 0;
    vstring = noSpace(vstring)[2];
    valid =  minLength(vstring,min)[0];
    vstring = maxLength(vstring,max)[2];
    if (valid) {
        return [1,"Username is valid...",onlyCharactersNum(vstring,pett,change)[2]];
    }else{
        return [0,"Username between "+min+" and "+max+" characters "+pett+" special characters...",vstring];
    }
}

function checkEmail(vstring,slen=100) {
    var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    vstring = vstring.replace(/\s+/g, "");
    vstring = maxLength(vstring,slen)[2];
    if(pattern.test(vstring)){
        return [1,"Email is valid...",vstring];
    }else{
        return [0,"Email is not valid...",vstring];
    }
}

function checkPhone(vstring,min=0,max=15){
    var pattern = /^[+][0-9][0-1][\s][0-9]{5}[\s][0-9]{5}$/;
    vstring = oneSpace(vstring)[2];
    var processed = "";
    for (i = 0; i < vstring.length; i++) {
        if(/[+0-9\s]/.test(vstring[i])){
            processed +=vstring[i];
        }
    }
    vstring = processed;
    valid = minLength(vstring,min)[0];
    vstring = maxLength(vstring,max)[2];
    if(vstring.length==3){
        vstring = vstring + " ";
    }else if(vstring.length==9){
        vstring = vstring + " ";
    }
    if (valid) {
        if(pattern.test(vstring)){
            return [1,"Phone is valid...",vstring];
        }else{
            return [0,"Phone is not valid enter in this pattern +00 00000 00000...",vstring];
        }
    }else{
        return [0,"Phone between "+min+" and "+max+" digits...",vstring];
    }

}

function CheckPassword(vstring,min=0,max=20) {
    vstring = vstring.replace(/\s+/g, "");
    if(vstring.length>max){
        vstring = vstring.substr(0,max);
    }
    if(vstring.length<min || vstring.length>max){
        return [0,"Password between "+min+" and "+max+" characters",vstring];
    }else{
        return [1,"Password is valid...",vstring];
    }
}

function CheckMessage(vstring,min=0,max=25,pett="",change=1){
    var valid = 0;
    vstring = oneSpace(vstring)[2];
    valid =  minLength(vstring,min)[0];
    vstring = maxLength(vstring,max)[2];
    if (valid) {
        // return [1,"Username is valid...",onlyCharactersNum(vstring,pett,change)[2]];
        return [1,"Username is valid...",vstring];
    }else{
        return [0,"Username between "+min+" and "+max+" characters "+pett+" special characters...",vstring];
    }
}

function checkIsValid(formObj){
    var savtot = 0;
    var totval = 0;
    for (value in formObj){
        savtot += formObj[value];
        totval++;
    }
    return savtot == totval;
}

function checkIsValidObj(formObj){
    var savtot = 0;
    var totval = 0;
    validation = [undefined, null, '', 'select'];
    for (row in formObj){
        if (row == 'isSubmit') {
            continue;
        }
        
        if (formObj[row]['isRequired']) {
            if (validation.includes(formObj[row]['val'])) {
                formObj[row]['msg'] = formObj[row]['comment'];
            } else{
                formObj[row]['msg'] = null;
            }
            savtot += formObj[row]['isValid'];
            totval++;
        }
    }
    formObj['isSubmit'] = savtot==totval;
    return formObj;
}