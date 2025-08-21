<!-- Hero Section -->
<section id="home" class="bg-gradient-to-r from-primary to-blue-700 text-white py-20 md:py-32 px-4 text-center relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-10" style="background-image: url('https://placehold.co/1000x800/<?php echo substr($THEMECOLORCODE, 1); ?>/FFFFFF?text=Pattern'); background-size: cover; background-position: center; filter: blur(2px);"></div>
    
    <div class="container mx-auto relative z-10 animate-fade-in">
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4">
            <?php echo $this->config->item('product_name'); ?>
        </h1>
        <p class="text-lg md:text-2xl mb-8 opacity-90">
            <?php echo $this->config->item('slogan'); ?>
        </p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
            <a href="<?php echo site_url('home/sign_up'); ?>" class="bg-white text-primary hover:bg-gray-100 font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:scale-105">
                <i class="fas fa-magic mr-2"></i> <?php echo $this->lang->line("ทดลองใช้ฟรี"); ?>
            </a>
            <a href="#features" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-primary font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:scale-105">
                <i class="fas fa-th-list mr-2"></i> <?php echo $this->lang->line("ดูฟีเจอร์ทั้งหมด"); ?>
            </a>
        </div>
    </div>
</section>

<!-- Features Section - Powered by Vue.js -->
<section id="features" class="py-16 md:py-24 px-4 bg-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-12 animate-fade-in-down">
            <?php echo $this->lang->line("ฟีเจอร์เด่น ที่จะเปลี่ยนธุรกิจของคุณ"); ?>
        </h2>

        <!-- Vue App Mount Point for Features -->
        <div id="features-app" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- FeatureCard component will be rendered here by Vue -->
        </div>
    </div>
</section>

<!-- How it works / Demo Video Section -->
<?php if ($this->config->item('display_video_block') == '1' && !empty($this->config->item('promo_video'))): ?>
<section class="py-16 md:py-24 px-4 bg-gray-50">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-12 animate-fade-in-down">
            <?php echo $this->lang->line("ระบบทำงานอย่างไร: ดูวิดีโอแนะนำ"); ?>
        </h2>
        <div class="relative w-full max-w-4xl mx-auto rounded-lg shadow-xl overflow-hidden" style="padding-top: 56.25%;"> <!-- 16:9 Aspect Ratio -->
            <iframe
                src="<?php echo str_replace('watch?v=', 'embed/', $this->config->item('promo_video')); ?>?rel=0&showinfo=0&iv_load_policy=3"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                class="absolute top-0 left-0 w-full h-full"
            ></iframe>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Customer Review Section -->
<?php if ($this->config->item('display_review_block') == '1' && !empty($this->config->item('customer_review'))): ?>
<section id="reviews" class="py-16 md:py-24 px-4 bg-primary text-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold mb-12 animate-fade-in-down">
            <?php echo $this->lang->line("เสียงจากลูกค้าผู้ใช้งานจริง"); ?>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($this->config->item('customer_review') as $index => $review): ?>
            <div class="bg-white p-8 rounded-lg shadow-xl text-gray-800 flex flex-col items-center animate-fade-in-up" style="animation-delay: <?php echo $index * 0.2; ?>s;">
                <img src="<?php echo base_url($review['image_path']); ?>" alt="<?php echo $review['name']; ?>" class="w-24 h-24 rounded-full object-cover mb-4 border-4 border-primary">
                <p class="text-lg italic mb-4">"<?php echo $review['review']; ?>"</p>
                <p class="font-bold text-primary"><?php echo $review['name']; ?></p>
                <p class="text-sm text-gray-600"><?php echo $review['title']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Pricing Section -->
<section id="pricing" class="py-16 md:py-24 px-4 bg-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-12 animate-fade-in-down">
            <?php echo $this->lang->line("ราคาแพ็กเกจที่ยืดหยุ่น"); ?>
        </h2>
        <p class="text-lg text-gray-600 mb-8">
            <?php echo $this->lang->line("เลือกแพ็กเกจที่เหมาะสมกับธุรกิจของคุณ"); ?>
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($pricing_table_data)): ?>
                <?php foreach ($pricing_table_data as $package): ?>
                    <div class="bg-gray-100 p-8 rounded-lg shadow-md border-t-4 border-primary hover:shadow-xl transform hover:-translate-y-1 transition duration-300">
                        <h3 class="text-2xl font-bold text-gray-800 mb-3"><?php echo $package['package_name']; ?></h3>
                        <p class="text-4xl font-extrabold text-primary mb-4">
                            <?php echo $curency_icon; ?>
                            <?php echo number_format($package['price']); ?>
                            <span class="text-lg text-gray-600">/ <?php echo $package['validity']; ?> <?php echo $this->lang->line("วัน"); ?></span>
                        </p>
                        <ul class="text-left text-gray-700 space-y-2 mb-6">
                            <?php 
                                $module_access = json_decode($package['module_access'], true);
                                if (!empty($module_access)) {
                                    foreach ($module_access as $module_id => $limit) {
                                        // You would map module_id to a user-friendly feature description and its limit
                                        // This requires mapping module_id to a language line or a predefined array of features
                                        // Example: $feature_name = $this->lang->line("module_".$module_id);
                                        // For now, using placeholder:
                                        echo '<li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> ' . $this->lang->line("ฟีเจอร์ ID") . ' ' . $module_id . ': ' . ($limit == -1 ? $this->lang->line("ไม่จำกัด") : $limit) . '</li>';
                                    }
                                } else {
                                    echo '<li class="flex items-center"><i class="fas fa-info-circle text-blue-500 mr-2"></i> ' . $this->lang->line("ไม่มีข้อมูลฟีเจอร์สำหรับแพ็กเกจนี้") . '</li>';
                                }
                            ?>
                        </ul>
                        <a href="<?php echo site_url('home/sign_up'); ?>" class="inline-block px-8 py-3 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition duration-300">
                            <?php echo $this->lang->line("สมัครใช้งาน"); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="col-span-full text-gray-600"><?php echo $this->lang->line("ไม่มีข้อมูลแพ็กเกจในขณะนี้"); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-16 md:py-24 px-4 bg-gray-100">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-12 animate-fade-in-down">
            <?php echo $this->lang->line("ติดต่อเรา"); ?>
        </h2>
        <p class="text-lg text-gray-600 mb-8">
            <?php echo $this->lang->line("มีข้อสงสัยหรือต้องการความช่วยเหลือใช่ไหม? ติดต่อเราได้เลย!"); ?>
        </p>
        <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <?php
              if($this->session->flashdata('contact_success')!='') {
                  echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>";
                      echo $this->session->flashdata('contact_success');
                  echo "</div>";
              }
              if($this->session->flashdata('contact_error')!='') {
                  echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>";
                      echo $this->session->flashdata('contact_error');
                  echo "</div>";
              }
            ?>
            <form action="<?php echo site_url('home/email_contact'); ?>" method="POST">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                
                <div class="mb-4 text-left">
                    <label for="contact_name" class="block text-gray-700 text-sm font-bold mb-2"><?php echo $this->lang->line("ชื่อของคุณ"); ?>:</label>
                    <input type="text" id="contact_name" name="contact_name" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <?php echo form_error('contact_name', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                </div>
                <div class="mb-4 text-left">
                    <label for="contact_email" class="block text-gray-700 text-sm font-bold mb-2"><?php echo $this->lang->line("อีเมลของคุณ"); ?>:</label>
                    <input type="email" id="contact_email" name="contact_email" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <?php echo form_error('contact_email', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                </div>
                <div class="mb-4 text-left">
                    <label for="contact_subject" class="block text-gray-700 text-sm font-bold mb-2"><?php echo $this->lang->line("หัวข้อ"); ?>:</label>
                    <input type="text" id="contact_subject" name="contact_subject" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <?php echo form_error('contact_subject', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                </div>
                <div class="mb-4 text-left">
                    <label for="contact_message" class="block text-gray-700 text-sm font-bold mb-2"><?php echo $this->lang->line("ข้อความ"); ?>:</label>
                    <textarea id="contact_message" name="contact_message" rows="5" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary" required></textarea>
                    <?php echo form_error('contact_message', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                </div>
                <div class="mb-6 text-left">
                    <label class="block text-gray-700 text-sm font-bold mb-2"><?php echo $this->lang->line("คำนวณ") . ': ' . $contact_num1 . ' + ' . $contact_num2; ?> = ?</label>
                    <input type="number" name="contact_captcha" class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <?php echo form_error('contact_captcha', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-full focus:outline-none focus:shadow-outline transition duration-300">
                    <i class="fas fa-paper-plane mr-2"></i> <?php echo $this->lang->line("ส่งข้อความ"); ?>
                </button>
            </form>
        </div>
    </div>
</section>

<script>
    // Vue Application Code for Features Section
    const { createApp, ref } = Vue;

    // Define FeatureCard component
    const FeatureCard = {
        props: ['feature'],
        template: `
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center text-center">
                <div :class="'text-4xl text-' + feature.color + '-600 mb-4'">
                    <i :class="feature.icon"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ feature.title }}</h3>
                <p class="text-gray-600 text-sm">{{ feature.description }}</p>
            </div>
        `
    };

    // Create Vue App Instance
    createApp({
        components: {
            FeatureCard // Register the component
        },
        setup() {
            // Data for features (can be fetched from an API in a real app, or passed from PHP)
            // ใช้ window.lang.features เพื่อดึงข้อมูลภาษาจาก PHP
            const features = ref([
                {
                    title: 'จัดการแชทบอทอัตโนมัติ',
                    description: 'สร้างและตั้งค่าแชทบอทอัจฉริยะสำหรับ Facebook Messenger และ Instagram Direct Message เพื่อตอบลูกค้าได้ตลอด 24 ชั่วโมง ช่วยลดภาระการทำงานของทีมคุณ',
                    icon: 'fas fa-robot',
                    color: 'blue'
                },
                {
                    title: 'ระบบดูดคอมเมนต์อัตโนมัติ',
                    description: 'ไม่พลาดทุกการขาย! ระบบจะดูดคอมเมนต์ใต้โพสต์ของคุณ และสามารถตอบกลับหรือสร้างออเดอร์ให้ลูกค้าได้ทันทีตามเงื่อนไขที่คุณตั้งค่าไว้',
                    icon: 'fas fa-comment-dots',
                    color: 'purple'
                },
                {
                    title: 'เชื่อมต่อขนส่งและชำระเงิน',
                    description: 'ผสานรวมกับผู้ให้บริการขนส่งชั้นนำในประเทศไทย และ Payment Gateway ยอดนิยม เพื่อให้การจัดการออเดอร์และการชำระเงินเป็นเรื่องง่ายและครบวงจร',
                    icon: 'fas fa-shipping-fast',
                    color: 'green'
                },
                {
                    title: 'รายงานและสถิติเชิงลึก',
                    description: 'วิเคราะห์ข้อมูลยอดขาย, พฤติกรรมผู้ติดตาม, และประสิทธิภาพของแคมเปญต่างๆ ได้อย่างละเอียด เพื่อให้คุณตัดสินใจทางธุรกิจได้อย่างแม่นยำยิ่งขึ้น',
                    icon: 'fas fa-chart-bar',
                    color: 'red'
                },
                {
                    title: 'รองรับ AI อัจฉริยะ (Gemini, ChatGPT)',
                    description: 'ยกระดับการสนทนาของแชทบอทด้วยการเชื่อมต่อกับ AI โมเดลชั้นนำ เพื่อการตอบคำถามที่ซับซ้อน, สร้างสรรค์, และเป็นธรรมชาติมากขึ้น สร้างความประทับใจให้ลูกค้า',
                    icon: 'fas fa-brain',
                    color: 'yellow'
                },
                {
                    title: 'จัดการทุกแพลตฟอร์มในที่เดียว',
                    description: 'รวมศูนย์การบริหารจัดการร้านค้าออนไลน์บน Facebook, Instagram, และ LINE Official Account ไว้ในแดชบอร์ดเดียว ช่วยให้คุณประหยัดเวลาและเพิ่มประสิทธิภาพ',
                    icon: 'fas fa-th-large',
                    color: 'indigo'
                }
            ]);

            return {
                features
            };
        }
    }).mount('#features-app'); // Mount the app to the div with id="features-app"
</script>