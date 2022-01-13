import $ from 'jquery';

class MyNotes{
    constructor(){
        this.events();
    }

    events(){
        $(".delete-note").on("click", this.deleteNote);
    }

    //Methods will go here
    deleteNote(){
        // alert("you clicked delete 1");
        $.ajax({
            beforeSend: (xhr)=>{
                xhr.setRequestHeader('X-WP-Nonce',universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/104',
            type: 'DELETE',
            success: (response)=>{
                console.log("Congrats");
                console.log(response);
            },
            error:  (response)=>{
                console.log("Sorry");
                console.log(response);
            },
        })
    }

}

export default MyNotes;
