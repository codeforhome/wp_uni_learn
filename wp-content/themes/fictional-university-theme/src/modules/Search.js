import $ from 'jquery';

class Search{
    // 1. describe and create/initiate our object
    constructor() {
        // alert("Hello I am a search.")
        this.resultsDiv = $('#search-overlay__results');
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay= $(".search-overlay");
        this.isOverlayOpen = false;
        this.searchField = $("#search-term");
        this.events();
        this.typingTimer;
        this.isSpinnerVisible = false;
        this.previousValue;
    }

    //2. events
    events(){
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keydown",this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }

    //3. method (function, action...)
    typingLogic(){
        if(this.searchField.val() != this.previousValue){
            clearTimeout(this.typingTimer);
            if(this.searchField.val()){ //if field is not empty
                if(!this.isSpinnerVisible){
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible=true;
                }
                this.typingLogic = setTimeout(

                    //     function (){
                    //     // console.log('timeout test');
                    // }
                    this.getResults.bind(this) , 2000);
            }else{
                this.resultsDiv.html('');
                this.isSpinnerVisible=false;
            }

        }

       this.previousValue = this.searchField.val();

    }


    getResults(){
        this.resultsDiv.html("Image search result here");
        this.isSpinnerVisible=false;

        // console.log('timeout test');
    }
    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        console.log('our open method just ran!');

    }

    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
       $("body").removeClass("body-no-scroll");
        console.log('our close method just ran!');

    }

    keyPressDispatcher(e){

        // console.log(e.keyCode);

        if(e.keyCode== 83 && !this.isOverlayOpen && $("input, textarea").is(':focus')){
            this.openOverlay();
            this.isOverlayOpen=true;
        }

        if(e.keyCode== 27  && this.isOverlayOpen){
            this.closeOverlay();
            this.isOverlayOpen=false;

        }
    }
}

export default Search