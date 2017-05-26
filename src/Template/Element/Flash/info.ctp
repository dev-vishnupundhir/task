<style>
.message.success {
    background-color: #d9edf7;
    border: 1px solid #bce8f1;
    color: #31708f;
    float: left;
    left: 0;
    margin: 0;
    padding: 10px;
    position: absolute;
    text-align: center;
    top: 0;
    width: 100%;
    z-index: 999;
}
</style>

<div class="message success" onclick="this.classList.add('hidden')"><?= h($message) ?></div>
<script type="text/javascript">
	$(document).ready(function() {
	$('.message').delay(4000).fadeOut(400);
});
</script>
