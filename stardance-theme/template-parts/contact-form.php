<section class="sd-section sd-contact" id="contact">
    <div class="sd-container">
        <h2 class="sd-heading sd-contact__title fade-in fade-in-delay-0">Get In Touch</h2>

        <form class="sd-contact__form fade-in fade-in-delay-1" id="stardance-contact-form" novalidate>
            <input type="hidden" name="action" value="stardance_contact">
            <input type="hidden" name="nonce" value="">

            <div class="sd-contact__fields">
                <div class="sd-contact__field">
                    <input type="text" name="name" placeholder="First Name" required>
                </div>
                <div class="sd-contact__field">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="sd-contact__field">
                    <input type="tel" name="phone" placeholder="Phone">
                </div>
                <div class="sd-contact__field">
                    <select name="interest">
                        <option value="" disabled selected>I'm interested in</option>
                        <option value="European Ballroom">European Ballroom</option>
                        <option value="Latin American">Latin American</option>
                        <option value="Latin Fusion Ladies">Latin Fusion Ladies</option>
                        <option value="Kids Programs">Kids Programs</option>
                        <option value="Wedding Choreography">Wedding Choreography</option>
                        <option value="Individual Lessons">Individual Lessons</option>
                    </select>
                </div>
                <div class="sd-contact__field sd-contact__field--full">
                    <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                </div>
            </div>

            <div class="sd-contact__submit">
                <button type="submit" class="sd-btn">Submit</button>
            </div>

            <div class="sd-contact__status" id="form-status" aria-live="polite"></div>
        </form>
    </div>
</section>
