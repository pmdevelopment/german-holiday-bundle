# german-holiday-bundle

Get german legal holidays as symfony2 bundle.

-- 

Deutsche gesetzliche Feiertage für Symfony2 als Bundle.

## Setup

Add to `AppKernel`

    new PM\Bundle\GermanHolidayBundle\PMGermanHolidayBundle(),
    
## Warnings

German holidays are a mess. Corpus christi is city based in Saxony and Thuringia, Assumption day in Bavaria.
 Those holidays are ignored for those states. Also you should always use the real year you are looking for,
 because in 2017 reformation day is country wide, so in this year the holidays are different.
     
## Usage

### Forms

Your Users probably need the state connection.

    ->add('state', ChoiceType::class, [
        'label'                     => 'label.state',
        'choices_as_values'         => true,
        'choice_translation_domain' => 'PMGermanHolidayBundle',
        'choices'                   => States::getAll(),
        'required'                  => false,
        'preferred_choices'         => [
            States::HESSE,
        ],
        'placeholder'               => 'help.empty',
    ])
    
### Get All

You can get all holidays by year. De result uses the `Holiday` object.

    $holidays = $this->getContainer()->get('pm_german_holiday.services.holiday_service')->getAll($year);
    
### More Stuff

The services uses some helper you can also use to get holidays by state or all holidays for one state.

    

