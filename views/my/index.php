<?php
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'webkam tz';
?>
<div class="tz-wrap">
    <div class="youtubeForm1">
        <h2 class="text-left">Первый экран</h2>
        
        <?php
        $form = ActiveForm::begin([
            'id' => 'form-input-example',
            'options' => [
                'class' => 'form-horizontal col-lg-12',
                'enctype' => 'multipart/form-data'
            ],
        ]);
        ?>
        <div class="youtubeInp">
            <input type="text" class="form-control" value="<?=Yii::$app->request->post('youtubeSearch')?>" name="youtubeSearch" placeholder="Введите поисковый запрос">
        </div>
        <div class="youtubeSubm">
            <input type="submit" class="btn btn-primary" value="Поиск">
        </div>
        <?php
        // Содержимое формы
        ActiveForm::end();
        ?>
        <div class="clearfix"></div>
    </div>

   <hr>
    <div class="videos2">
	<h2 class="text-left">Второй экран</h2>
        <?php
        if ($videos2) {
            echo '<div class="videos1__list">';
            foreach ($videos2 as $key => $value) {
                echo '<div class="videos2__item">
                        <a href="#" class="videos2__item_href" data-id="'.$value->id.'" >
                            <div class="videos2__item_img">
                                <img src="' . $value->snippet->thumbnails->default->url . '" alt="">
                            </div>
                            <div class="videos2__item_name">
                                ' . $value->snippet->title . '
                            </div>
                            </a>
                            <hr>
                            <div class="videos2__item_date">
                                Опубликовано : ' . date('d-m-Y',strtotime($value->snippet->publishedAt)) . '
                            </div>
                     
                            <div class="videos2__item_athor">
                                Автор : ' . $value->snippet->channelTitle . '
                            </div>
                            <div class="videos2__item_athor">
                                Просмотров : ' . $value->statistics->viewCount . '
                            </div>
                        
                        
                   </div>';
            }
            echo '</div>';
        }else{
            echo '<p class="youtube_nf">По данному запросу ничего не найдено либо запрос пуст</p>';
        }
        ?>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>
