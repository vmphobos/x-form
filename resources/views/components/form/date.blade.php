<div wire:key="{{ $uuid }}" >
    {{-- LABEL --}}
    @if ($label)
        <x-form.label
            :for="$uuid"
            :label="$label"
            :model="$model"
            :modifier="$attributes->has('live') || $attributes->has('blur')"
            :icon="$icon"
            :tooltip="$tooltip"
            :help="$help"
            :required="$required"
        />
    @endif

    {{-- THE INPUT --}}
    <div
        x-data="{
            locale: 'en',
            open: false,
            day: new Date().getDate().toString().padStart(2, '0'),
            month: (new Date().getMonth() + 1).toString().padStart(2, '0'),
            year: new Date().getFullYear(),
            date: '',
            display_date: '',
            showMonthList: false,
            editYear: false,
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            updateDate() {
                this.date = `${this.year}-${String(this.month).padStart(2, '0')}-${this.day}`;
                this.display_date = `${this.year}/${String(this.month).padStart(2, '0')}/${this.day}`;
                $wire.set('{{ $model }}', this.date, false);
            },
            init() {
                if ($wire.get('{{ $model }}')) {
                    const [y, m, d] = $wire.get('{{ $model }}').split('-');
                    this.year = y;
                    this.month = m;
                    this.day = d;
                    this.display_date = `${y}/${m}/${d}`;
                }
            },
            selectedDate() {
                return new Date(`${this.year}-${this.month}-${this.day}`);
            },
            makeDate(input) {
                if (!input || input.trim() === '') {
                    this.date = '';
                    this.display_date = '';
                    $wire.set('{{ $model }}', null, false);
                    return;
                }

                const parts = input.split('/');
                if (parts.length !== 3) return;

                const [y, m, d] = parts;
                if (y && m && d) {
                    this.year = y;
                    this.month = m;
                    this.day = d;

                    this.date = `${y}-${m}-${d}`;
                    this.display_date = input;
                    $wire.set('{{ $model }}', this.date, false);
                }
            },
            setDate(d) {
                this.day = d.toString().padStart(2, '0');
                const m = this.month.toString().padStart(2, '0');
                const y = this.year;

                this.date = `${y}-${m}-${this.day}`;
                this.display_date = `${y}/${m}/${this.day}`;
                $wire.set('{{ $model }}', this.date, false);
            },
            setMonth(increase) {
                if (increase) {
                    if (this.month < 12) {
                        this.month++;
                    } else {
                        this.month = 1;
                        this.year++;
                    }
                } else {
                    if (this.month > 1) {
                        this.month--;
                    } else {
                        this.month = 12;
                        this.year--;
                    }
                }

                this.date = `${this.year}-${String(this.month).padStart(2, '0')}-${this.day}`;
                this.display_date = `${this.year}/${String(this.month).padStart(2, '0')}/${this.day}`;
                $wire.set('{{ $model }}', this.date, false);
            },
            daysGap() {
                const d = new Date(`${this.year}-${this.month}-01`);
                return (d.getDay() + 6) % 7; // Adjust to start with Monday
            },
            translatedWeekdayNames() {
                return ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            },
            translatedMonthName() {
                return this.selectedDate().toLocaleString(this.locale, { month: 'long' });
            },
            longDayName() {
                return this.selectedDate().toLocaleString(this.locale, { weekday: 'long' });
            },
            lastDateOfMonth() {
                return new Date(this.year, this.month, 0).getDate();
            },
            isWeekend(day) {
                const date = new Date(`${this.year}-${this.month}-${day}`);
                return date.getDay() === 6 || date.getDay() === 0;
            }
        }"
        class="relative"
    >
        {{-- DATE INPUT --}}
        <input
            x-model="display_date"
            x-mask="9999/99/99"
            x-ref="calendar"
            @click="open = !open"
            @keyup="makeDate($el.value)"
            type="text"
            id="{{ $uuid }}"
            name="{{ $model }}"
            autocomplete="off"
            placeholder="YYYY/MM/DD"
            class="{{ config('x-form.input') }}"
        />

        @error($rule)
            <div class="{{ config('x-form.error') }}">{!! $message !!}</div>
        @enderror

        {{-- DATEPICKER --}}
        <div
            x-show="open"
            x-anchor="$refs.calendar"
            class="absolute z-10 mt-2 flex flex-col gap-2 w-72 h-76 rounded-lg backdrop-blur-xl dark:text-white shadow-xl"
            @click.away="open = false; console.log(date)"
            x-cloak
        >
            <div class="flex items-center justify-between font-bold text-lg py-4">

                {{-- PREVIOUS MONTH --}}
                <button type="button" class="hover:cursor-pointer hover:opacity-70 ms-2" @click="setMonth(false)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                </button>

                <div class="flex flex-col gap-1 items-center">
                    <div class="flex items-center space-x-2">
                        {{-- EDIT MONTH --}}
                        <button
                            type="button"
                            class="hover:text-blue-500"
                            @click="showMonthList = !showMonthList; editYear = false"
                            x-text="translatedMonthName()"
                        ></button>

                        {{-- EDIT YEAR --}}
                        <button
                            type="button"
                            class="hover:text-blue-500"
                            @click="editYear = true; showMonthList = false;"
                            x-show="!editYear"
                            x-text="year"
                        ></button>

                        {{-- YEAR INPUT --}}
                        <input
                            type="number" class="w-18 border rounded px-1 text-center"
                            x-show="editYear"
                            x-model="year"
                            @blur="editYear = false; updateDate()"
                            @keydown.enter="editYear = false; updateDate()"
                        />
                    </div>

                    <div
                        class="text-xs font-normal text-zinc-500"
                        x-text="longDayName() + ' ' + day + ' ' + translatedMonthName() + ' ' + year"
                    ></div>
                </div>

                {{-- NEXT MONTH --}}
                <button type="button" class="hover:cursor-pointer hover:opacity-70 me-2" @click="setMonth(true)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                </button>
            </div>

            {{-- MONTH LIST --}}
            <div x-show="showMonthList" class="grid grid-cols-3 gap-2 p-2">
                <template x-for="(m, index) in monthNames" :key="index">
                    <button
                        type="button"
                        class="px-2 py-1 rounded hover:bg-zinc-100"
                        @click="month = index + 1; showMonthList = false; updateDate()"
                        x-text="m"
                    ></button>
                </template>
            </div>

            {{-- DAYS LIST --}}
            <div x-show="!showMonthList" class="grid grid-cols-7 justify-center items-center p-2">
                {{-- WEEKDAY HEADERS --}}
                <template x-for="d in translatedWeekdayNames()" :key="d">
                <span
                    class="w-full flex items-center py-1 justify-center font-medium text-sm text-zinc-600"
                    x-text="d"
                ></span>
                </template>

                {{-- BLANK DAYS --}}
                <template x-for="g in daysGap()" :key="g">
                    <span></span>
                </template>

                {{-- MONTH DAYS --}}
                <template x-for="ld in Array.from({ length: lastDateOfMonth() }, (_, i) => i + 1)" :key="ld">
                    <button
                        type="button"
                        class="w-full flex items-center py-1 justify-center rounded-md hover:cursor-pointer hover:bg-zinc-50 dark:hover:bg-white/5 dark:hover:text-white"
                        :class="{
                        'font-bold bg-zinc-100 text-blue-500 opacity-100': day == ld,
                        'opacity-50': isWeekend(ld)
                    }"
                        x-text="ld"
                        @click="setDate(ld); editYear = false"
                    ></button>
                </template>
            </div>
        </div>
    </div>
</div>
