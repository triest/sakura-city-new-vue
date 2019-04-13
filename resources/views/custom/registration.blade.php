@extends('layouts.blog', ['title' => 'Регистрация'])


@section('content')



    <div class='container text--center join--title'>
        <h1>Регистрация аккаунта</h1>
    </div>
    <div class='wrapper wrapper--login'>

        <div class=''>
            <div class='panel-body'>
                <div class="container">
                    <form action="{{route('joinStore')}}" class='form-horizontal joinForm' role='form' id='joinForm'
                          method='POST'>
                        {{ csrf_field() }}
                        <input type='hidden' name='step' value='2'>
                        <input type='hidden' name='join' value='yes'>
                        <div id='mail_selection_div' class='card island' style='display: block;'>
                            <div class="form-group row">
                                <label for="you" class="col-sm-2 col-form-label">Вы</label>
                                <div class="col-sm-10">
                                    <div class='ControlGroup'>
                                        <div class='select'>
                                            <select name='you' id="you">
                                                <option value='famele'>Женщина</option>
                                                <option value='male'>Мужчина</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kogo" class="col-sm-2 col-form-label">Ищете</label>
                                <div class="col-sm-10">
                                    <div class='ControlGroup'>
                                        <div class='select'>
                                            <select name='kogo' id="kogo">
                                                <option value='male'>Мужчину</option>
                                                <option value='famale'>Женщину</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Ваше имя</label>
                                <div class="col-sm-10">
                                    <input type='text' name='name' class='text-input  ' value='{{old('name')}}'
                                           required>
                                    @if($errors->has('name'))
                                        <font color="red"><p>  {{$errors->first('name')}}</p></font>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Ваш email</label>
                                <div class="col-sm-10">
                                    <input type='text' name='email' id="email" class='text-input  '
                                           value='{{old('email')}}'
                                           required>
                                    @if($errors->has('email'))
                                        <font color="red"><p>  {{$errors->first('email')}}</p></font>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Пароль</label>
                                <div class="col-sm-10">
                                    <input type='text' name='password' id="password" value='{{old('password')}}'
                                           required>
                                    @if($errors->has('password'))
                                        <font color="red"><p>  {{$errors->first('password')}}</p></font>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Подтверждение
                                    пароля</label>
                                <div class="col-sm-10">
                                    <input type='text' name='password_confirmation' class='text-input  '
                                           value='{{old('password')}}'
                                           required>

                                    <p class='Login-helpText'>Продолжая, вы соглашаетесь с <a id="myBtn">правилами</a>
                                        сайта Sakura-city и подтверждаете что вам больше 18 лет. Запрещается
                                        продвигать незаконную коммерческую деятельность (например,
                                        проституцию). </p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">Закрыть</span>
            <br>
            <h3>Соглашение об условиях использования сайта</h3>
            <br>

            <p><b>Вступление</b></p>


            <p>
                Сайт создан для того, чтобы Вы могли найти новых людей, общаться, знакомиться и встречаться.
            </p>
            <p>
                Очень важно для Вас и для нас, чтобы на Сайте всегда оставалась спокойная и доброжелательная
                обстановка.
            </p>
            <p>
                Вы должны внимательно и полностью ознакомиться с Соглашением об условиях использования Cайта (далее
                -
                "Условия использования"), до осуществления регистрации на Сайте. Осуществление Вами регистрации на
                Сайте
                означает, что Вами прочитано Соглашение об условиях использования Cайта, Условия использования Вам
                понятны, Вы согласны с ними и обязуетесь их соблюдать.
            </p>

            <p><b>Определения</b></p>

            <p>
                1. Сайт - общая совокупность информации и программ для электронно-вычислительных машин (ЭВМ),
                содержащаяся на материальном носителе и функционирующая на программно-аппаратном комплексе,
                обеспечивающем доступность указанной информации в сети Интернет по сетевому адресу sakura-city.info
            </p>
            <p>
                2. Владелец Сайта - лицо (лица), имеющие соответствующие права на сетевой адрес, по которому
                находится
                Сайт.
            </p>
            <p>
                3. Администрация Сайта - лицо (лица), уполномоченные Владельцем Сайта на обеспечение деятельности
                Сайта,
                контроль за его функционированием, соблюдением действующего законодательства Российской Федерации и
                настоящих Условий использования.
            </p>
            <p>
                4. Пользователь Сайта - дееспособное физическое лицо, достигшее 18 лет, использующее Сайт в
                соответствии
                с настоящими Условиями использования.
            </p>
            <p>
                5. Открытые идентифицирующие данные пользователя (логин) - информация, сообщаемая со стороны
                Пользователя Сайту, служащая для идентификации Пользователя и отождествления лица, использующего
                Сайт, с
                регистрационной информацией о Пользователе.
            </p>
            <p>
                6. Закрытые идентифицирующие данные Пользователя - (пароль, «секретный вопрос» и ответ на «секретный
                вопрос», проверочные коды) – информация, сообщаемая со стороны Пользователя Сайту, служащая для
                подтверждения идентификации Пользователя и подтверждения отождествления лица, использующего Сайт, с
                регистрационной информацией о Пользователе.
            </p>
            <p>
                7. Идентифицирующие данные Пользователя - совокупность открытых и закрытых идентифицирующих данных
                Пользователя.
            </p>


            <p><b>Общие положения</b></p>


            <p>
                Условия использования являются публичной офертой в соответствии со статьей 437 Гражданского кодекса
                Российской Федерации
            </p>
            <p>
                Пользователями Сайта могут быть только дееспособные физические лица, достигшие 18 лет.
            </p>
            <p>
                Настоящие Условия использования применяются ко всем аспектам взаимодействия Пользователя и Сайта,
                Администрации и Владельцев Сайта.
            </p>
            <p>
                На Сайте могут быть материалы, наличие и содержание которых, возможно, вызовет у Пользователя
                возражения
                морального (этического) плана. Используя Сайт, Пользователь подтверждает, что осознает вероятность
                этого
                и допускает возможность наличия на Сайте материалов (текстов, фотографий и т.п.), не согласующихся с
                его
                морально-этическими установками.
            </p>
            <p>
                Администрация Сайта не принимает участие в формировании и использовании содержания, и контроле
                доступа
                других пользователей к персональной странице Пользователя.
            </p>
            <p>
                Размещенные Пользователями на Сайте материалы и информация, содержащая мнения, предположения и
                оценочные
                суждения, являются исключительно мнениями, предположениями и оценочные суждениями данных
                Пользователей.
            </p>
            <p>
                Осуществляя регистрацию на Сайте и дальнейшее использование Сайта, Пользователь подтверждает свое
                согласие на обработку (в том числе автоматизированную) Администрацией Сайта его персональных данных,
                предоставленных при регистрации, а также размещаемых Пользователем на своей персональной странице.
                Обработка персональных данных Пользователя осуществляется в соответствии с законодательством
                Российской
                Федерации.
            </p>
            <p>
                Кроме информации, размещенной Пользователями с соблюдением настоящих Условий использования на Сайте
                в
                разделе «Информация пользователя», вся информация и иные результаты интеллектуальной деятельности, в
                том
                числе (но не ограничиваясь) тексты, графика, фотографии, товарные знаки и знаки обслуживания,
                музыкальные и аудиовизуальные произведения, программы для ЭВМ, дизайн являются собственностью
                владельца
                Сайта.
            </p>
            <p>
                Ни в каком случае, кроме как по письменному разрешению Администрации Сайта, Пользователь не получает
                право на использование фирменного наименования, товарного знака, доменного имени и иных
                отличительных
                признаков Сайта. Администрации Сайта, Владельцев Сайта
            </p>
            <p>
                За исключением случаев, предусмотренных действующим законодательством Российской Федерации и
                настоящими
                Условиями использования, никакая информация и содержимое Сайта не может быть скопирована
                (воспроизведена), переработана, распространена, отображена, опубликована, сохранена, передана,
                продана
                или иным способом использована как целиком, так и по частям, без предварительного разрешения
                правообладателя, кроме случаев, когда правообладатель явным образом выразил свое согласие на
                указанные
                действия со стороны любого лица.
            </p>
            <p>
                Все действия, совершенные с использованием идентифицирующих данных Пользователя, рассматриваются
                Администрацией и Владельцами Сайта, как совершенные данным Пользователем. Бремя доказательства
                обратного
                лежит на Пользователе.
            </p>
            <p>
                Все сообщения, отправленные Администрацией Сайта, Владельцами Сайта и Пользователями,
                предназначаются
                исключительно для адресатов таких сообщений.
            </p>

            <p><b>Пользователь имеет право:</b></p>

            <p>
                - пользоваться Cайтом исключительно в личных некоммерческих целях;
            </p>
            <p>
                - самостоятельно, с соблюдением настоящих Условий использования, создавать, использовать и
                определять
                содержание собственной персональной страницы и условия доступа других Пользователей к ее содержанию
                (содержимому);
            </p>
            <p>
                - осуществлять доступ и размещения информации на персональных страницах других Пользователей, при
                условии получения от них соответствующих прав доступа;
            </p>
            <p>
                - сохранять отдельные элементы Сайта (страницы) для просмотра на компьютере исключительно для
                личного
                некоммерческого просмотра;
            </p>

            <p><b>Пользователь обязан:</b></p>

            <p>
                - осуществлять регулярное ознакомление с Условиями использования;
            </p>
            <p>
                - при осуществлении процедуры регистрации на Сайте Пользователь обязан предоставить необходимую
                достоверную и актуальную информацию для формирования учетной записи и персональной страницы
                Пользователя, включая логин и пароль доступа к Сайту, и выполнить иные действия, необходимые для
                регистрации и подтверждения регистрации на Сайте. Программное обеспечение Сайта может запрашивать у
                Пользователя дополнительную информацию.
            </p>
            <p>
                - нести полную ответственность за точность, актуальность, полноту и достоверность всех материалов и
                информации, которые Пользователь размещает на Сайте, а также за соблюдение режима конфиденциальности
                всех материалов и информации, которые Пользователь размещает на Сайте.
            </p>
            <p>
                - использовать Сайт в соответствии с законодательством Российской Федерации.
            </p>
            <p>
                - не вводить в заблуждение и не оскорблять других Пользователей Сайта
            </p>
            <p>
                - нести исключительную ответственность за точность, достоверность и соответствие законодательству
                Российской Федерации информации и материалов, размещаемых Пользователями на Сайте. Пользователь
                обязуется самостоятельно оценивать содержание размещаемых на Сайте Пользователем информации и
                материалов
                на соответствие требованиям действующего законодательства Российской Федерации
            </p>
            <p>
                - руководствоваться общепринятыми нормами общения в отношении других Пользователей Сайта. В том
                случае,
                если какой-либо Пользователь Сайта не желает поддерживать общение с тем или иным Пользователем, о
                чем
                прямо и недвусмысленно сообщит таковому Пользователю посредством предусмотренных на Сайте способов
                взаимодействия (в том числе на общедоступном форуме и/или через личное (персональное) сообщение),
                указанный Пользователь должен воздержаться от дальнейшего общения.
            </p>
            <p>
                - не использовать Сайт для продажи любых товаров и услуг, распространения рекламных материалов,
                осуществления любых видов политической, религиозной, национальной и иной пропаганды, как прямо, так
                и
                косвенно.
            </p>
            <p>
                - не использовать Сайт для совершения любой противоправной деятельности, в частности не совершать
                деяний, запрещенных гражданским, уголовным законодательством и законодательством об административных
                правонарушениях;
            </p>
            <p>
                - не размещать на Сайте информацию, описывающую или пропагандирующую привлекательность употребления
                наркотических веществ любого рода и вида, информацию о распространении наркотиков, рецепты их
                изготовления и советы по употреблению
            </p>
            <p>
                - не размещать на Сайте информацию, пропагандирующую любого вида псевдо- или паранаучные явления,
                методики, концепции.
            </p>
            <p>
                - не использовать Сайт для массовой рассылки рекламных и иных материалов и информации («спама»);
            </p>
            <p>
                - не использовать программное обеспечение и не осуществлять действия, направленные на нарушение
                нормального функционирования как всего сайта в целом, так и его отдельных элементов;
            </p>
            <p>
                - при использовании Сайта воздерживаться об обнародования известной Пользователю конфиденциальной
                информации, в том числе информации о месте проживания, номерах телефонов, адресов электронной почты,
                паспортных данных, налоговой и банковской информации, информации о частной жизни лица, без согласия
                указанного лица, полученного в установленном законом порядке. Администрация Сайта вправе запросить у
                Пользователя документы, подтверждающие наличие такого согласия.
            </p>
            <p>
                - не размещать на Сайте информацию, к которой предусмотрен ограниченный доступ, в том числе
                информацию,
                содержащую государственную и (или) коммерческую тайну, независимо от основания обладания такой
                информацией.
            </p>
            <p>
                - не размещать на Сайте ссылки на другие ресурсы сети «Интернет» без предварительного письменного
                согласия Администрации Сайта;
            </p>
            <p>
                - получить предварительное письменное согласие Администрации Сайта на передачу своего права
                пользования
                Сайтом (логин и пароль) другим лицам.
            </p>
            <p>
                - обеспечить недоступность для третьих лиц закрытых идентифицирующих данных Пользователя. В случае
                возникновения у Пользователя подозрения об осуществленном доступе третьих лиц (в том числе других
                Пользователей) к закрытым идентифицирующим данным Пользователя, он обязан немедленно поставить об
                этом в
                известность Администрацию Сайта с использованием существующей на сайте формы связи с Администрацией
                Сайта;
            </p>
            <p>
                - не совершать действий, имеющих целью получение доступа к закрытой идентификационной информации
                другого
                Пользователя;
            </p>
            <p>
                - не размещать высказывания и (или) информацию, содержащую оскорбления, непристойные заявления,
                заявления, оскорбляющие человеческое достоинство, национальные и религиозные чувства других
                пользователей;
            </p>
            <p>
                - не размещать высказывания и (или) информацию, пропагандирующие преступную деятельность или
                содержащие
                советы и (или) руководства по совершению преступных действий;
            </p>
            <p>
                - не загружать, не хранить, не публиковать, не распространять и не предоставлять доступ или иным
                образом
                не использовать, а равно не способствовать использованию вредоносного программного обеспечения,
                серийных
                номеров к коммерческим программным продуктам и программы для их генерации, логинов, паролей и прочих
                средств для получения несанкционированного доступа к платным ресурсам в сети Интернет, а также не
                размещать ссылки на вышеуказанную информацию;
            </p>
            <p>
                - не размещать информацию, распространение которой запрещено законодательством Российской Федерации,
                в
                том числе информацию, содержащую призывы о насильственном изменении конституционного строя,
                разжигании
                расовой, национальной, религиозной розни, совершении экстремистских действий, дискриминации по
                расовым,
                религиозным, национальным, половым, имущественным или иным признакам, либо одобрение вышеуказанного.
            </p>
            <p>
                - не размещать информацию, нарушающую законодательство об авторском праве и интеллектуальной
                собственности, в частности, не размещать материалы, содержащие изображения других людей без их
                разрешения. Администрация Сайта вправе запросить у Пользователя документы, подтверждающие наличие
                такого
                разрешения.
            </p>
            <p>
                - при использовании Пользователем информации и материалов, доступ к которым получен Пользователем
                исключительно для личного некоммерческого использования, обеспечить сохранение всех знаков авторства
                (копирайтов) или других уведомлений об авторстве, сохранения имени автора в неизменном виде,
                сохранении
                произведения в неизменном виде.
            </p>
            <p>
                - использовать программы для автоматизированного сбора информации на Сайте и(или) взаимодействия с
                Сайтом и его сервисами;
            </p>
            <p>
                - не размещать фотографии интимного содержания в открытом доступе. Данные фотографии следует
                размещать в
                подразделе "интимные фотографии" профиля (анкеты) Пользователя, доступ к которым предоставляется
                персонально каждому Пользователю сайта после его запроса. На Сайте запрещается размещать
                порнографические материалы и любые материалы, связанные с педофилией.
            </p>
            <p>
                - не размещать иную информацию, которая является по мнению Администрации Сайта нежелательной, не
                соответствующей целям создания и функционирования Сайта, ущемляющей права и интересы иных
                Пользователей,
                или по иным причинам являющейся нежелательной для размещения на Сайте, и немедленно удалять такую
                информацию.
            </p>


            <p><b>Администрация Сайта имеет право:</b></p>


            <p>
                - изменять, модифицировать, добавлять или удалять положения Условий использования, размещенных по
                адресу
                sakura-city.info/rules, в любое время, но не чаще, чем один раз в сутки (по времени Сайта).
                Продолжение
                использования Сайта Пользователем после внесения изменений означает, что Пользователь согласен с
                этими
                изменениями.
            </p>
            <p>
                - прекращать доступ к опубликованным материалам Пользователя при модерации анкеты и/или блокировать
                Пользователя в случае нарушения им Условий использования без предупреждения Пользователя.
            </p>
            <p>
                - в случае нарушения Пользователем любого из положений настоящих Условий использования в
                одностороннем
                порядке, без согласия и уведомления Пользователя, расторгнуть настоящие Условия использования,
                прекратить использование Пользователем Сайта, удалить персональную страницу (анкету) Пользователя;
            </p>
            <p>
                - редактировать или удалять любые материалы на сайте, не соответствующие Условиям использования,
                или,
                исходя из усмотрения Администрации Сайта, являющиеся наносящими вред Владельцам Сайта, Администрации
                Сайта, другим Пользователям Сайта или третьим лицам.
            </p>
            <p>
                - сообщать в соответствии с действующим законодательством о деятельности отдельных Пользователей и
                (или)
                размещенных ими материалах, нарушающих законодательство Российской Федерации, в соответствующие
                компетентные органы. При этом Администрация Сайта имеет право предоставить всю известную ей
                информацию о
                таком Пользователе в соответствующие компетентные органы без его согласия и уведомления.
            </p>
            <p>
                - отправлять Пользователю сообщения, сообщать Пользователю новости и уведомлять о действиях других
                Пользователей (отправлять Пользователю рекламные сообщения, сообщения от службы поддержки Сайта, и
                от
                других пользователей).
            </p>
            <p>
                - создавать в автоматическом режиме сообщения, приглашения, поздравления, напоминания для целей
                информирования или развлечения. Используя Сайт, Пользователь выражает свое согласие на получение
                таких
                сообщений, приглашений, поздравлений, напоминаний.
            </p>
            <p>
                - периодически размещать информацию о товарах, услугах и иных предложениях третьих лиц, в том числе
                в
                виде ссылок. Такое размещение осуществляется исключительно для информирования пользователей. Данная
                информация не является рекомендацией Администрации Сайта, факт ее размещения не означает, что
                Администрация Сайта имеет какое-либо отношение к лицам, упоминаемым в данной информации.
                Администрация
                Сайта не несет ответственности за содержание данной информации, в том числе ее полноту и точность, а
                также не несет ответственности за любые убытки, ущерб, повреждения, расходы или возможную
                ответственность, которые Пользователь может понести, используя данную информацию, в том числе
                вступая в
                контакт с лицами, упоминаемыми в данной информации.
            </p>


            <p><b>Риски и ответственность</b></p>

            <p>
                Пользователь осуществляет использование Сайта исходя из положения «как есть». Никакие явные или
                подразумеваемые обещания, гарантии от имени Администрации и (или) Владельцев Сайта не могут быть
                даны и
                подразумеваемы.
            </p>
            <p>
                Администрация и Владельцы Сайта не могут гарантировать, что работа Сайта постоянно будет
                непрерывной,
                бесперебойной и корректной. Администрация Сайта не несет ответственности за временные сбои и
                перерывы в
                работе Сайта и вызванную ими потерю информации.
            </p>
            <p>
                Администрация Сайта не может гарантировать совместимость используемого Пользователем программного и
                аппаратного обеспечения с программным и аппаратным обеспечением Сайта. Все риски и возможные убытки,
                проистекающие из несовместимости используемого Пользователем программного и аппаратного обеспечения
                с
                программным и аппаратным обеспечением Сайта относятся на Пользователя.
            </p>
            <p>
                Администрация и Владельцы Сайта не несут ответственности за убытки и ущерб любого рода, включая без
                ограничения прямой ущерб, упущенную выгоду, даже если таковые явились следствием обстоятельств, о
                которых Пользователь уведомлял Администрацию и (или) Владельцев Сайта в том числе, в случаях:
                наличия
                неточной информации на Сайте, перерывами и задержками в функционировании Сайта, нарушением любым
                лицом
                любых прав на объекты интеллектуальной собственности и авторского права третьих лиц, связанным с
                использованием Сайта, любыми убытками, причиненными воздействием вредоносного программного
                обеспечения,
                даже если это явилось следствием доступа на Сайт, использования Сайта или получения сообщений
                электронной почты от Сайта, содержанием и истинностью информации, полученной на других сайтах в сети
                Интернет, ссылки на которые были размещены на Сайте, а также любым взаимодействием с данными
                сайтами.

            </p>
            <p>
                Администрация не несет ответственности за любой ущерб компьютеру Пользователя или иного лица,
                мобильным
                устройствам, любому другому оборудованию или программному обеспечению, вызванный или связанный со
                скачиванием (сохранением) материалов с Сайта или по ссылкам, размещенным на Сайте.
            </p>
            <p>
                Администрация и Владельцы Сайта не несут ответственности за любые убытки, материальный и моральный
                вред,
                потерю информации или любой другой ущерб, в том числе в случае, если возможно было предвидеть, что
                это
                происходит во время использования Сайта.
            </p>
            <p>
                Пользователь использует Сайт исключительно на свой риск. Известный риск использования сети
                «Интернет»
                состоит в том, что люди могут быть не теми, за кого себя выдают, предоставлять недостоверную,
                ненадежную
                или незаконную информацию, вести себя неподобающим образом, или нарушать закон.
            </p>
            <p>
                Администрация Сайта не имеет возможности проверить точность и достоверность информации и материалов,
                размещаемых Пользователями, и не несет ответственности за подлинность и достоверность такой
                информации и
                материалов.
            </p>
            <p>
                Администрация Сайта не имеет возможности проверять правдивость утверждений Пользователей, а также
                гарантировать применимость размещенных анкет к тому или иному Пользователю и соответствие
                содержащейся в
                анкете информации реальности. В вопросах общения только каждый Пользователь может принимать решения
                по
                своему усмотрению, и Сайт рекомендует проявлять соответствующую осторожность. Используя Сайт,
                Пользователь соглашается с этим и принимает данные риски.
            </p>
            <p>
                На Сайте не осуществляется предварительный контроль и цензурирование действий Пользователей.
            </p>
            <p>
                Администрация Сайта не несет ответственности за нарушение Пользователем норм действующего
                законодательства Российской Федерации и предпринимает действия по защите прав и законных интересов
                третьих лиц и обеспечению соблюдения требований действующего законодательства Российской Федерации
                только после обращения заинтересованного лица и (или) представителей компетентных органов к
                Администрации Сайта в порядке, установленном действующим законодательством Российской Федерации. В
                случае предъявления к Администрации Сайта и (или) Владельцам Сайта претензий со стороны третьих лиц
                и
                (или) соответствующих компетентных органов, Пользователь обязуется самостоятельно, за свой счет,
                предпринять все меры по урегулированию данных претензий.
            </p>
            <p>
                В случае предъявления к Администрации Сайта и (или) Владельцам Сайта третьими лицами претензий,
                требований, исков относительно нарушения законодательства об авторском праве в отношении материалов
                и
                (или) информации, размещенных Пользователем, Пользователь обязуется самостоятельно предпринять все
                меры
                по урегулированию данных претензий, требований, исков. При возникновении указанных обстоятельств
                Администрация Сайта вправе без согласия и предварительного уведомления Пользователя удалить спорные
                материалы и (или) информацию, а также приостановить использование Пользователем Сайта и доступ к
                персональной странице (анкете) Пользователя.
            </p>


            <p><b>Заключительные положения</b></p>

            <p>
                Настоящие Условия использования составляют соглашение между Пользователем и Администрацией Сайта
                относительно порядка использования Сайта и его сервисов, и заменяют собой все предыдущие соглашения
                между Пользователем и Администрацией.
            </p>
            <p>
                Настоящие Условия использования становятся обязательными для Пользователя с момента его регистрации
                на
                Сайте и действуют в течение неопределенного срока.
            </p>
            <p>
                Настоящие Условия использования регулируются и толкуются в соответствии с действующим
                законодательством
                Российской Федерации.
            </p>
            <p>
                Если по тем или иным причинам одно или несколько положений настоящих Условий использования будут
                признаны недействительными, или не имеющими юридической силы, это не повлияет на действительность
                остальных положений.
            </p>
            <p>
                Вопросы, не урегулированные настоящими Условиями использования, подлежат разрешению в соответствии с
                действующим законодательством Российской Федерации.
            </p>
            <p>
                Администрация и Владельцы Сайта имеют право прекратить доступ к Сайту в случае нарушения
                Пользователем
                любого условия настоящих Условий использования.
            </p>
            <p>
                В случае возникновения любых споров или разногласий, связанных с исполнением настоящих Условий
                использования, Пользователь и Администрация Сайта приложат все усилия для их разрешения путем
                проведения
                переговоров. В случае, если спор или разногласие не будут разрешены путем переговоров в течение 90
                дней
                с момента получения первой письменной претензии, спор или разногласие подлежат разрешению в порядке,
                установленном действующим законодательством Российской Федерации.
            </p>

            <button class="btn btn-primary" id="clouseModal">Закрыть</button>
        </div>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        var clouseModal=document.getElementById("clouseModal");

        clouseModal.onclick= function () {
            modal.style.display = "none";

        };

        // When the user clicks the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        };
        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        };


        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>



@endsection
