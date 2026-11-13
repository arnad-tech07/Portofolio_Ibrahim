<!-- Bagian Maps & Detail Lokasi (Dikelola via CMS) -->
<div class="map-embed-wrapper">
    <iframe 
        src="{{ $setting->maps_embed_url ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126930.2223456789!2d106.789123!3d-6.208763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%20Pusat%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid' }}" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"
        title="Lokasi Kantor & Workshop {{ $setting->name ?? 'Ibrahim' }}">
    </iframe>
</div>
