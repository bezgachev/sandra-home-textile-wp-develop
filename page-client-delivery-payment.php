<?php
/*
Template Name: Доставка и оплата
Template Post Type: page
*/
?>
<?php get_header(); ?>
<div class="client">
	<h1 class="title-h1 client__title"><?php the_title(); ?></h1>
	<div class="container client__wrapper">
		<section class="client__container">
            <?php the_content(); ?>
            <h3>Способы получения:</h3>
            <?php
                $deliverys = get_field('delivery');
                if($deliverys) {
                    foreach($deliverys as $delivery) {
                        $delivery_title = $delivery['delivery-title'];
                        $delivery_descr = $delivery['delivery-descr'];
                        echo '<span><h4>' . $delivery_title . '</h4><p>' . $delivery_descr . '</p></span>';
                    }
                }
            ?>
            <h3>Варианты оплаты:</h3>
            <?php
                $payments = get_field('payment');
                if($payments) {
                    foreach($payments as $payment) {
                        $payment_title = $payment['payment-title'];
                        $payment_descr = $payment['payment-descr'];
                        echo '<div><h4>— ' . $payment_title . '</h4><p>' . $payment_descr . '</p></div>';
                    }
                }
            ?>
            <h3>Сроки:</h3>
            <?php
                $delivery_deadlines = get_field('deadlines-text');
				echo '<p>' . $delivery_deadlines . '</p>';
			?>
		</section>
		<button class="title-h3 client__nav_btn">Навигация</button>
		<div class="client__nav">
			<button class="client__nav_esc"></button>
			<div class="title-h3 client__nav_title">Быстрая Навигация:</div>
			<ul class="client__nav_links">
				<li class="client__nav_link"><a href="<?php echo get_permalink(34); ?>" class="text"><span>Условия сотрудничества</span></a></li>
				<li class="client__nav_link active"><a href="<?php echo get_permalink(22); ?>" class="text">Доставка и оплата</a></li>
				<li class="client__nav_link"><a href="<?php echo get_permalink(18); ?>" class="text"><span>Возврат и обмен</span></a></li>
				<li class="client__nav_link"><a href="<?php echo get_permalink(20); ?>" class="text"><span>Вопросы и ответы</span></a></li>
			</ul>
		</div>
	</div>
</div>
<?php get_footer(); ?>