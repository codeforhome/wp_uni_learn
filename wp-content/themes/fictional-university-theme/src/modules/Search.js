import $ from 'jquery';

class Search{
    // 1. describe and create/initiate our object
    constructor() {
        // alert("Hello I am a search.")
        this.addSearchHtml();
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
                this.typingLogic = setTimeout(this.getResults.bind(this) , 750);
            }else{
                this.resultsDiv.html('');
                this.isSpinnerVisible=false;
            }

        }

       this.previousValue = this.searchField.val();

    }


    getResults(){
        $.getJSON(universityData.root_url +'/wp-json/university/v1/search?term=' + this.searchField.val(), (results) =>{
            this.resultsDiv.html(`
            <div class="row">
                <div class="one-third">
                    <h2 class="search-overlay__section-title">General Information</h2>
                      ${results.generalInfo.length ? ' <ul class="link-list min-list">' : '<p>No General information matched the search </p>'}
                      ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${ item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
                      ${results.generalInfo.length ? '</ul>' : ''}             
                </div>
                <div class="one-third">
                    <h2 class="search-overlay__section-title">Programs</h2>
                      ${results.programs.length ? ' <ul class="link-list min-list">' : `<p>No programs matched the search. <a href="${universityData.root_url}/program">View all programs</a> </p>`}
                      ${results.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                      ${results.programs.length ? '</ul>' : ''}                
                    <h2 class="search-overlay__section-title">Professors</h2>
                      ${results.professors.length ? ' <ul class="professor-cards">' : `<p>No professors matched the search. </p>`}
                      ${results.professors.map(item => `
                     <li class="professor-card__list-item"><a class="professor-card" href="${item.permalink}">
                       <img class="professor-card__image" src="${item.image}">
                       <span class="professor-card__name"> ${item.title}</span>
                        </a></li>
                      `).join('')}
                      ${results.professors.length ? '</ul>' : ''}                      
                </div>
                <div class="one-third">
                    <h2 class="search-overlay__section-title">Campuses</h2>
                      ${results.campuses.length ? ' <ul class="link-list min-list">' : `<p>No campuses matched the search  <a href="${universityData.root_url}/campus">View all campuses</a> </p>`}
                      ${results.campuses.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                      ${results.campuses.length ? '</ul>' : ''}                     
                    <h2 class="search-overlay__section-title">Events</h2>
                      ${results.events.length ? '' : `<p>No events matched the search  <a href="${universityData.root_url}/campus">View all events</a> </p>`}
                      ${results.events.map(item => `
                                          
                    
                    <div class="event-summary">
                        <a class="event-summary__date t-center" href="${item.permalink}">
                                            <span class="event-summary__month">${item.month}</span>
                            <span class="event-summary__day">${item.day}</span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                            <p><?php
                                //echo wp_trim_words(get_the_content(),18);
                                if(has_excerpt()){
                                    echo get_the_excerpt();
                                }else{
                                    echo wp_trim_words(get_the_content(),18);
                                }
                    
                                ?><a href="${item.permalink}" class="nu gray">Learn more</a></p>
                        </div>
                    </div>
                      `).join('')}
               
                </div>
            </div>
            `);
            this.isSpinnerVisible = false;
        });

    }
    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        this.searchField.val('');
        setTimeout(() =>this.searchField.focus(),301);
        console.log('our open method just ran!');

    }

    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
       $("body").removeClass("body-no-scroll");
        console.log('our close method just ran!');

    }

    keyPressDispatcher(e){

        // console.log(e.keyCode);

        if(e.keyCode== 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')){
            this.openOverlay();
            this.isOverlayOpen=true;
        }

        if(e.keyCode== 27  && this.isOverlayOpen){
            this.closeOverlay();
            this.isOverlayOpen=false;

        }
    }

    addSearchHtml(){
        $("body").append(`
        <div class="search-overlay"> <!-- //search-overlay--active -->
    <div class="search-overlay__top">
        <div class="container">
            <i class="fa fa-search search-overlay__icon aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="what are you looking for?" id="search-term" autocomplete="off">
            <i class="fa fa-window-close search-overlay__close aria-hidden="true"></i>

        </div>
    </div>

    <div class="container">
        <div id="search-overlay__results"></div>
    </div>
</div>
        `);
    }
}

export default Search