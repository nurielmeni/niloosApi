<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\widgets\memadEmployee\MemadEmployeeWidget;

$this->title = 'אודות';
?>

<header>
    <h1 class="text-center fg-white">על המימד השלישי</h1>
</header>

<article class="about">
    <div class="row center-block">
        <div class="col-sm-6 col-xs-12 right">
            <p><strong>מערכת הגיוס וניהול המידע המתקדמת, בשילוב עם עבודה מקצועית ללא פשרות של צוות הגיוס שלנו, מאפשרים לנו יכולת איתור והתאמה של מועמדים ומועמדות במהירות, ביעילות ובכפוף לדרישות התפקיד.</strong></p>
            <p>הגישה השירותית והמקצועית של מנהלי ומנהלות הלקוחות שלנו, מאפשרת ללקוחותינו להתמקד בבדיקת קו"ח של המועמדים המתאימים ביותר וזאת לאחר שעברו סינון ומיון קפדני.</p>
            <p><strong>לכל המועמדים שלנו וללקוחותינו, מובטחת דיסקרטיות מוחלטת.
    קו"ח של המועמדים השונים לצד דרישות התפקיד של לקוחותינו נשמרים בחשאיות מוחלטת.</strong></p>
        </div>
        <div class="col-sm-6 col-xs-12 left">
            
            <ul>
                <h3>מדוע כדאי לעבוד אתנו:</h3>
                <li>שנות ניסיון רבות בגיוס והשמה של עובדים, מנהלים ובכירים בשוק הישראלי ובשווקים רבים בחו"ל.</li>
                <li>רשת קשרים רחבה עם מנהלים ועובדים בכירים בחברות היי-טק ואחרות בשוק המקומי.</li>
                <li>מחויבות לתהליך ולתוצאות. אנו רואים את עצמנו כשותפים מלאים לתהליך הגיוס מתחילתו ועד סופו.</li>
                <li>ביצוע בפועל של תהליכי Head Hunting מורכבים וייחודיים המבטיחים הגעה למועמדים ספציפיים תוך התחייבות לחיסיון מוחלט של התהליך כלפי הארגון וגורמי שוק אחרים.</li>
                <li>מערכת גיוס חדשנית, המנהלת מאגר מידע עדכני שכולל מאות אלפי מועמדים/ות.</li>
                <li>שירותיות ומהימנות ללא פשרות. אנו עומדים לרשות לקוחותינו בכול זמן ועת. </li>
            </ul>
        </div>
    </div>
</article>

<section class="about-employees">
    <?= Html::tag('h2', 'הצוות שלנו', ['class' => 'memad-section-title  text-center']) ?>
    <div class="panels-employees flex space-between">
        <?php foreach($employees as $employee) : ?>
            <?= MemadEmployeeWidget::widget(['model' => $employee]) ?>
        <?php endforeach; ?>
    </div>
</section>