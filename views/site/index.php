<?php
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="tz-wrap">
    <div class="youtubeForm1">
        <h2>Задание 1</h2>
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
    <div class="videos1">
        <?php
        if ($videos1) {
            echo '<div class="videos1__list">';
            foreach ($videos1 as $key => $value) {
                echo '<div class="videos1__item">
                        <div class="videos1__item_img">
                            <img src="' . $value->snippet->thumbnails->default->url . '" alt="">
                        </div>
                        <div class="videos1__item_name">
                            ' . $value->snippet->title . '
                        </div>
                        <div class="videos1__item_date">
                            ' . date('d-m-Y',strtotime($value->snippet->publishedAt)) . '
                        </div>
                    </div>';
            }
            echo '</div>';
        }else{
            echo '<p class="youtube_nf">По данному запросу ничего не найдено либо запрос пуст</p>';
        }
        ?>
    </div>

    <div class="youtubeForm2">
        <h2>Задание 2</h2>
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
            <input type="text" class="form-control" value="<?=Yii::$app->request->post('youtubeSearch2')?>"  placeholder="Введите поисковый запрос" name="youtubeSearch2">
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
    <div class="videos2">
        <?php
        if ($videos2) {
            echo '<div class="videos1__list">';
            foreach ($videos2 as $key => $value) {
                echo '<div class="videos2__item">
                        <a href="#" class="videos2__item_href" data-id="'.$value->id->videoId.'" >
                            <div class="videos2__item_img">
                                <img src="' . $value->snippet->thumbnails->default->url . '" alt="">
                            </div>
                            <div class="videos2__item_name">
                                ' . $value->snippet->title . '
                            </div>
                            </a>
                            <div class="videos2__item_date">
                                ' . date('d-m-Y',strtotime($value->snippet->publishedAt)) . '
                            </div>
                            <div class="videos2__item_athor">
                                ' . $value->snippet->channelTitle . '
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
