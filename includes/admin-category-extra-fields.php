<tr class="form-field">
    <th scope="row" valign="top"><label for="Cat_meta[background-color]"><?php _e('Category Background Color'); ?></label></th>
    <td>
        <input type="text" name="Cat_meta[background-color]" id="Cat_meta[background-color]" maxwidth="7" style="width:60%;" value="<?php echo $cat_meta['background-color'] ? $cat_meta['background-color'] : ''; ?>"><br />
        <span class="description"><?php _e('Hex color value for each category (e.g. #000000)'); ?></span>
    </td>
</tr>
<tr class="form-field">
    <th scope="row" valign="top"><label for="Cat_meta[soundcloud-playlist-url]"><?php _e('Soundcloud Playlist URL'); ?></label></th>
    <td>
        <input type="text" name="Cat_meta[soundcloud-playlist-url]" id="Cat_meta[soundcloud-playlist-url]" maxwidth="150" style="width:60%;" value="<?php echo $cat_meta['soundcloud-playlist-url'] ? $cat_meta['soundcloud-playlist-url'] : ''; ?>"><br />
        <span class="description"><?php _e('URL to Soundcloud Playlist to display in footer of category'); ?></span>
    </td>
</tr>