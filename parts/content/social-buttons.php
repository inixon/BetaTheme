<div class="social__buttons">
          <a title="Twitter" aria-label="Twitter" class="social__button twitter"
              href="https://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php the_permalink(); ?>"
              onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;">Twitter
          </a>
          <a title="Facebook" aria-label="Facebook" class="social__button facebook"
              href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
              onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;">Facebook
          </a>
          <a title="Whatsapp" aria-label="Whatsapp" class="social__button Whatsapp mobile"
            href="whatsapp://send?text=<?php the_permalink(); ?>" target="_blank">WhatsApp
        </a>
        <a title="Whatsapp" aria-label="Whatsapp" class="social__button Whatsapp desktop"
            href="https://web.whatsapp.com/send?text=<?php the_permalink(); ?>">WhatsApp
        </a>
        <a title="Pinterest" aria-label="Pinterest" target="_blank" class="social__button Pinterest"
            href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&description=<?php the_title(); ?>">Pinterest
        </a>
        <a title="Copy URL to clipboard" aria-label="Copy URL to clipboard" class="social__button toclipboard" href="#">Copy URL
        </a>
</div>
