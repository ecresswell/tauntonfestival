---
layout: dance
title: Dance Festival Photo Gallery 2016
pictures:
  - url: "/wp-content/uploads/2016/10/dance-festival/Alice_Groves.JPG"
    width: 480
    height: 640
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/Alice_Groves__Amelia_Smith.JPG"
    width: 1536
    height: 2048
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/Alice_Groves__Amelia_Smith__Ella_Stracey.JPG"
    width: 2048
    height: 1536
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/Alice_Groves__Ella_Stracey__Amelia_Smith.JPG"
    width: 2048
    height: 1536
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/Amelia_Smith.JPG"
    width: 1536
    height: 2048
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/Beth_Larkman.JPG"
    width: 2364
    height: 1331
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/Bethany_Pearce.PNG"
    width: 640
    height: 960
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/Gala_Evening.JPG"
    width: 3264
    height: 2448
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_0872.JPG"
    width: 480
    height: 640
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_0873.JPG"
    width: 416
    height: 640
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_0876.JPG"
    width: 480
    height: 640
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_0983.JPG"
    width: 480
    height: 640
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_0986.JPG"
    width: 480
    height: 640
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_0990.JPG"
    width: 480
    height: 640
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_0991.JPG"
    width: 480
    height: 640
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_2597.JPG"
    width: 240
    height: 320
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_2603.JPG"
    width: 320
    height: 240
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_2606.JPG"
    width: 240
    height: 320
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_2607.JPG"
    width: 240
    height: 320
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_2608.JPG"
    width: 240
    height: 320
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_2609.JPG"
    width: 240
    height: 320
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_2610.JPG"
    width: 240
    height: 320
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_2611.JPG"
    width: 240
    height: 320
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/IMG_2612.JPG"
    width: 240
    height: 320
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/Jasmine_Larkman.JPG"
    width: 2364
    height: 1331
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/Jasmine_Larkman_2.JPG"
    width: 2364
    height: 1331
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/TDC_photo_1.JPG"
    width: 2448
    height: 3264
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/TDC_photo_2.JPG"
    width: 2448
    height: 3264
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/TDC_photo_3.JPG"
    width: 2448
    height: 3264
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/TDC_photo_4.JPG"
    width: 2448
    height: 3264
    caption: ""
  - url: "/wp-content/uploads/2016/10/dance-festival/TDC_photo_5.JPG"
    width: 2448
    height: 3264
    caption: ""
---

<style type='text/css'>
    #gallery-1 {
        margin: auto;
    }
    #gallery-1 .gallery-item {
        float: left;
        margin-top: 10px;
        text-align: center;
        width: 50%;
    }
    #gallery-1 img {
        border: 2px solid #cfcfcf;
    }
    #gallery-1 .gallery-caption {
        margin-left: 0;
    }
    /* see gallery_shortcode() in wp-includes/media.php */
</style>
        
<div id='gallery-1' class='gallery gallery-columns-2 gallery-size-medium'>
    {% for picture in page.pictures %}
        {% if picture.width > picture.height %}
            {% assign width = 300 %}
            {% capture height %}{{ picture.height | times: 300 | divided_by: picture.width }}{% endcapture %}
        {% else %}
            {% assign height = 300 %}
            {% capture width %}{{ picture.width | times: 300 | divided_by: picture.height }}{% endcapture %}
        {% endif %}
        <dl class='gallery-item'>
            <dt class='gallery-icon'>
                <a href="{{ picture.url | prepend: site.github.url }}" data-rel="lightbox-gallery-1">
                    <img width="{{ width }}" height="{{ height }}" src="{{ picture.url | prepend: site.github.url }}" class="attachment-medium size-medium" alt="{{ picture.caption }}"/>
                </a>
            </dt>
            <dd class='wp-caption-text gallery-caption'>
                {{ picture.caption }}
            </dd>
        </dl>
    {% endfor %}
    <br style='clear: both' />
</div>
