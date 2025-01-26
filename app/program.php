<li class="form__item">
    <label for="event" class="form__label">Participation à quel évènement ? <span class="form__asterisk" aria-hidden="true">*</span></label>
    <select class="form__input" name="event" id="event">
        <option value="">- Sélectionne un évènement -</option>
        <?php

        // Créer les options de choix de l'evenement
        $events = fetchAllEvents($dbCo);
        foreach ($events as $event) {
            echo '<option value="' . $event['id'] . '">' . $event['name'] . '</option>';
        }

        ?>
    </select>
</li>
<li class="form__item">
    <label class="form__label" for="date">Date de passage <span class="form__asterisk" aria-hidden="true">*</span></label>
    <input class="form__input" type="date" name="date" id="date" required>
</li>
<li class="form__item">
    <label class="form__label" for="time">Heure de passage <span class="form__asterisk" aria-hidden="true">*</span></label>
    <input class="form__input" type="time" name="time" id="time" required>
</li>