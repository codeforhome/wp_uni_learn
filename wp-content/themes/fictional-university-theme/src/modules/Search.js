import $ from 'jquery';

class Search{
    // 1. describe and create/initiate our object
    constructor() {
        // alert("Hello I am a search.")
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay= $(".search-overlay");
        this.isOverlayOpen = false;
        this.events();
    }

    //2. events
    events(){
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keydown",this.keyPressDispatcher.bind(this));
    }

    //3. method (function, action...)
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

        if(e.keyCode== 83 && !this.isOverlayOpen){
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