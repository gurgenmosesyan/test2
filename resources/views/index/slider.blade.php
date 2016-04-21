<div id="jssor" style="position:relative;width:1200px;height:563px;overflow:hidden;visibility: hidden;">
    <?php /*
    <div data-u="loading" style="position:absolute;top:0;left:0;">
        <div style="filter: alpha(opacity=70); opacity:0.7;position:absolute;display:block;top:0;left:0;width:100%;height:100%;"></div>
        <div style="position:absolute;display:block;background:url('/images/loading.gif') no-repeat center center;top:0;left:0;width:100%;height:100%;"></div>
    </div>
    */ ?>
    <div data-u="slides" style="cursor:default;position:relative;top:0;left:0;width:1200px;height:563px;overflow:hidden;">
        @foreach($slider as $value)
            <div data-p="112.50" style="display:none;">
                <img data-u="image" src="{{$value->getImage()}}" />
            </div>
        @endforeach
    </div>
    <div data-u="navigator" class="jssorb05" style="bottom:12px;right:12px;" data-autocenter="1">
        <div data-u="prototype" style="width:21px;height:21px;"></div>
    </div>
    <span data-u="arrowleft" class="jssora12l" style="top:0;left:0;width:51px;height:51px;" data-autocenter="2"></span>
    <span data-u="arrowright" class="jssora12r" style="top:0;right:0;width:51px;height:51px;" data-autocenter="2"></span>
</div>