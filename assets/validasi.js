
function konversitext(tx){
    let text = tx.toUpperCase();
    console.log("ini: "+text);
    // return tx.val;
}

function lockbutton(btn){
    $("#"+btn+"").prop('disabled', true);
}

function cekpassword(){
    let pass_1 = $("#pass1").val();
    let pass_2 = $("#pass2").val();
    if(pass_2 !== pass_1){
        alert("password yang diinput tidak sama");
        $("#btn-reg").prop('disabled', true);
        $("#pass2").focus();
    }
    else{
        $("#btn-reg").prop('disabled', false);
    }
    
}