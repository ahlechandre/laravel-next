<ul class="mdc-list mdc-list--two-line">
  @foreach($items as $item)
    <li class="mdc-list-item">
      <span class="mdc-list-item__text">
        {{ $item['text'] }}
        <span class="mdc-list-item__secondary-text">
          {{ $item['secondaryText'] }}
        </span>
      </span>
    </li>
  @endforeach
</ul>