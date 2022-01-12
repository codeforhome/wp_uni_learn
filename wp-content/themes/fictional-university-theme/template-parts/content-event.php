

<div class="event-summary">
    <a class="event-summary__date t-center" href="#">
                        <span class="event-summary__month"><?php
                            $evenDate =  new DateTime(get_field('event_date'));
                            echo $evenDate->format('M');

                            ?></span>
        <span class="event-summary__day"><?php
            $evenDate =  new DateTime(get_field('event_date'));
            echo $evenDate->format('d');
            ?></span>
    </a>
    <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p>${item.description}<a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
    </div>
</div>