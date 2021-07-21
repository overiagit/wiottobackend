$(document).ready(function(event){

    $('#btnAddRoom').on('click' , (event) => {
        event.preventDefault();
        let villa = '';
        let sep = '';
        const chkLVilla = document.querySelectorAll("#chlVilla  input[type=checkbox]:checked");
        chkLVilla.forEach(function (item){
            villa += sep + item.value;
            sep = ',';
        });
        const rooms = document.querySelector("#new_room_cnt");
        const exb = document.querySelector("#new_room_exb");
        const name =document.querySelector("#hidden_name").value;
        const hotel_id = document.querySelector("#hidden_hotel_id").value;
        $.ajax({
            url:'/room/create',
            data:{'villa': villa, 'hotel_id':hotel_id, 'name':name , 'rooms':rooms.value, 'exb':exb.value},
            method:'POST',
            success: function(data) {
                console.log(data); // Возвращаемые данные выводим в консоль
                data = JSON.parse(data);
                if(data['res'] === 'OK'){
                    const opt = document.createElement('option');
                    opt.value =  data['id'];
                    opt.innerHTML = data['name'];
                    document.querySelector("#select-room_type_id").appendChild(opt);
                    // opt.selected = true;
                    document.querySelector("#select-room_type_id").value = opt.value;
                    $("#uniroom-room_type_id").val(opt.value);
                    rooms.value = 1;
                    exb.value = 1;
                    document.querySelectorAll("#chlVilla  input[type=checkbox]").forEach(function (item){
                        item.checked = item.value === '0';
                    });
                    document.querySelector("#my-success").style.display = "block";
                }
                else{
                    document.querySelector("#my-warning").style.display = "block";
                }
            },
            error: function (data){
                console.log(data);
            },
            complete:function (data) {
                $('#frmCreateRoom').modal('hide');
            }
        })

    });

});