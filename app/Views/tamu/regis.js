
            var row_i = 0;

            function emptyRow() {
                row_i++;
                this.obj = $("<tr></tr>");
                this.obj.append('<td style="width:45px;"><input type="text" class="form-control" size="5" value="' + row_i +
                    '"/></td>');
                this.obj.append('<td><input type="text" class="form-control" size="5" style="width:100%;" name="mm[]" id="id_mm' +
                    row_i +
                    '""/></td>');
                this.obj.append('<td><input type="text" class="form-control" size="5" style="width:100%;" name="dd[]" id="id_dd' +
                    row_i +
                    '""/></td>');
            }

            function refresh(new_count) {
                //how many applications we have drawed now ?
                //console.log("New count= " + new_count);
                if (new_count > 1) {
                    $("#verse1").show();
                    $("#noa_header").show();
                } else {
                    $("#verse1").hide();
                    $("#noa_header").hide();
                }
                var old_count = parseInt($('#verse1 tbody').children().length);
                //console.log("Old count= " + old_count);
                //the difference, we need to add or remove ?
                var rows_difference = parseInt(new_count) - old_count - 1;
                //console.log("Rows diff= " + rows_difference);
                //if we have rows to add
                if (rows_difference > 0) {
                    for (var i = 0; i < rows_difference; i++)
                        $('#verse1 tbody').append((new emptyRow()).obj);
                } else if (rows_difference < 0) //we need to remove rows ..
                {
                    var index_start = old_count + rows_difference + 1;
                    //console.log("Index start= " + index_start);
                    $('#verse1 tr:gt(' + index_start + ')').remove();
                    row_i += rows_difference;
                }
            }

            $(document).ready(function() {

                $('#guest_personel').change(function() {
                    refresh($(this).val());
                })

            });
            var row_i = 0;

            function emptyRow2() {
                row_i++;
                this.obj = $("<tr></tr>");
                this.obj.append('<td style="width:45px;"><input type="text" class="form-control" size="5" value="' + row_i +
                    '"/></td>');
                this.obj.append('<td><input type="text" class="form-control" size="5" style="width:100%;" name="mmB[]" id="id_mmB' +
                    row_i +
                    '""/></td>');
                this.obj.append('<td><input type="text" class="form-control" size="5" style="width:100%;" name="ddB[]" id="id_ddB' +
                    row_i +
                    '""/></td>');
            }

            function refresh2(new_count) {
                //how many applications we have drawed now ?
                //console.log("New count= " + new_count);
                if (new_count > 1) {
                    $("#verse2").show();
                    $("#noa_header2").show();
                } else {
                    $("#verse2").hide();
                    $("#noa_header2").hide();
                }
                var old_count = parseInt($('#verse2 tbody').children().length);
                //console.log("Old count= " + old_count);
                //the difference, we need to add or remove ?
                var rows_difference = parseInt(new_count) - old_count - 1;
                //console.log("Rows diff= " + rows_difference);
                //if we have rows to add
                if (rows_difference > 0) {
                    for (var i = 0; i < rows_difference; i++)
                        $('#verse2 tbody').append((new emptyRow2()).obj);
                } else if (rows_difference < 0) //we need to remove rows ..
                {
                    var index_start = old_count + rows_difference + 1;
                    //console.log("Index start= " + index_start);
                    $('#verse2 tr:gt(' + index_start + ')').remove();
                    row_i += rows_difference;
                }
            }

            $(document).ready(function() {
                $('#guest_personel2').change(function() {
                    refresh2($(this).val());
                })

            });
            function b64toBlob(b64Data, contentType, sliceSize) {
                contentType = contentType || '';
                sliceSize = sliceSize || 512;

                var byteCharacters = atob(b64Data);
                var byteArrays = [];

                for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                    var slice = byteCharacters.slice(offset, offset + sliceSize);

                    var byteNumbers = new Array(slice.length);
                    for (var i = 0; i < slice.length; i++) {
                        byteNumbers[i] = slice.charCodeAt(i);
                    }

                    var byteArray = new Uint8Array(byteNumbers);

                    byteArrays.push(byteArray);
                }

                var blob = new Blob(byteArrays, {
                    type: contentType
                });
                return blob;
            }




            $(document).ready(function() {

                $('#result_desktop').hide();
                $('#result_desktop2').hide();
                $('#result_desktop3').hide();
                $('#result_desktop4').hide();
                $('#needs_ndcteam').hide();
                $('#needs_others').hide();
                $('#needs_ndcteam2').hide();
                $('#needs_others2').hide();

                $('#refer_to').change(function() {
                    var val_refer = $('#refer_to').val();
                    if (val_refer == "NDC Team") {
                        $('#needs_ndcteam').show();
                        $('#needs_others').hide();
                        console.log(val_refer)
                    } else {
                        $('#needs_others').show();
                        $('#needs_ndcteam').hide();
                        console.log(val_refer)
                    }
                })

                $('#refer_to2').change(function() {
                    var val_refer = $('#refer_to2').val();
                    if (val_refer == "NDC Team") {
                        $('#needs_ndcteam2').show();
                        $('#needs_others2').hide();
                    } else {
                        $('#needs_others2').show();
                        $('#needs_ndcteam2').hide();
                    }
                })
                //Timepicker
                $('#timepicker').datetimepicker({
                    format: 'HH:mm:ss'
                });
                $('#timepicker2').datetimepicker({
                    format: 'HH:mm:ss'
                });

                $("#datepicker-icon").wrap('<div style="position:relative;"></div>');
                $("#datepicker-icon2").wrap('<div style="position:relative;"></div>');
                $("#datepicker-icon-out").wrap('<div style="position:relative;"></div>');
                $("#datepicker-icon-out2").wrap('<div style="position:relative;"></div>');
                $('.select2').select2({
                    theme: "bootstrap4"
                });
                // $('#login_date').daterangepicker();
                $('input[name=language]').on('change', function() {
                    $(this).closest("form").submit();
                });

                $('input[type=radio][name=needs_of]').change(function() {
                    var needs = document.querySelector('input[name="needs_of"]:checked').value;
                    $('input[name=chosen_radio]').val(needs);
                    //console.log(needs);
                });

                $('input[type=radio][name=needs_of2]').change(function() {
                    var needs = document.querySelector('input[name="needs_of2"]:checked').value;
                    $('input[name=chosen_radio2]').val(needs);
                    //console.log(needs);
                });

                $('#dc_location').on('change', function() {
                    var locations = $('#dc_location').val();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Is ' + locations + ' the right destination?',
                        icon: 'warning',
                        showDenyButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        denyButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#dc_location').val(locations);
                            Swal.fire('Saved!', '', 'success')
                        } else if (result.isDenied) {
                            $("#dc_location").val('NDC Jakarta').trigger('change');
                            Swal.fire('Changes are not saved', '', 'info')
                        }
                    })
                });

                $('#dc_location2').on('change', function() {
                    var locations = $('#dc_location2').val();
                    Swal.fire({
                        title: 'Apa anda yakin?',
                        text: locations + ' benar lokasi data center tujuan anda?',
                        icon: 'warning',
                        showDenyButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        denyButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#dc_location2').val(locations);
                            Swal.fire('Tersimpan!', '', 'success')
                        } else if (result.isDenied) {
                            $("#dc_location2").val('NDC Jakarta').trigger('change');
                            Swal.fire('Perubahan tidak tersimpan', '', 'info')
                        }
                    })
                });

                var checked = $("#outputs").val();
                var spinner = $('#loader');
                if (checked == "us") {
                    //ShowCam();
                    //ShowCam2();

                    $("#form-survey-us").css("display", "block");
                    $("#form-survey-id").css("display", "none")
                    $("#captcha").css("display", "block").attr('required', true);
                    $("#captcha2").css("display", "none").attr('required', false);

                    $('#form-survey-us').submit(function(event) {
                        event.preventDefault();
                        var formData = new FormData(this);
                        formData.append('csrf_test_name', '9e2e8fdf78ce3e58848832ba3d78813c');

                        var htmlContent = document.createElement("div");
                        htmlContent.innerHTML = "<div align='justify' style='height:15em;overflow-y: scroll;width: 100%;font-size:12px;'><p><strong>Privacy Policy Nusantara Data Center</strong></p><p><strong>Introduction</strong></p><p>The following Privacy Policy Notice describes how we, Nusantara Data Center obtain, collect, store, control, use, process, analyze, correct, update and protect your Personal Data.</p><p>Please read this Privacy Policy thoroughly to ensure that you understand Our data protection practices.</p><p><strong>Acknowledgment and Consent</strong></p><p>By agreeing to the Privacy Policy, You acknowledge that You have read and understood this Privacy Policy and agree to its terms. In particular, You agree and consent to Us Processing Your Personal Data in accordance with this Privacy Policy.</p><p>If you provide Us with Personal Data relating to another individual (such as Personal Data relating to your spouse, family member, friend, coworker, employee or other party), then you represent and warrant that you have obtained the consent of such individual, and hereby agree on behalf of such individual, to Our Processing of their Personal Data. We may ask you for evidence of such consent at any time.</p><p><strong>1. TYPES OF PERSONAL DATA WE COLLECT</strong></p><p>To the extent permitted by Applicable Laws, We may process, collect, use and store different types of Personal Data consisting of general and specific Personal Data about You which We have categorized as follows:</p><p><strong>a. Identity Data</strong> includes name, username, identity card, User identity or other identifier, position, date of birth, gender, place of birth, occupation, nationality, personal photo and photo of Personal Identification / Identity Card / Passport.</p><p><strong>b. Contact Data</strong> including personal address, address of current employer, email address, personal phone number and phone number linked to the Whatsapp app.</p><p><strong>2. IF YOU PROVIDE INCOMPLETE PERSONAL DATA</strong></p><p>When We need to collect Personal Data by law, or under the terms of an agreement We have with You, and You choose not to provide such Personal Data or provide incomplete Personal Data to Us when requested, then we are unable to grant You permission to enter Nusantara Data Center's premises, We are unable to provide services and perform the agreements that exist or are in the process of being entered into with You.</p><p><strong>3. HOW WE COLLECT YOUR PERSONAL DATA</strong></p><p>The Personal Data that We collect may be provided by You through the Visitor Nusantara Data Center application (apps.ndcmoratelindo.com) each time when You will enter the Nusantara Data Center area or data sent to Our official email for the purpose of Visitor Nusantara Data Center registration.</p><p>If there are more than 1 (one) person at the time of the visit, then you must be willing to include those individuals and include data about the third parties who participate in your visit. In such cases, you will of course need the consent of the other third party individuals -see “Acknowledgment and Consent” above, for more information.</p><p><strong>4. HOW WE USE YOUR PERSONAL DATA</strong></p><p>We may use the Personal Data collected for the following purposes:</p><p><table><tr><th style='width:20px;'></th><th></th></tr><tr><td>i.</td><td>to identify and register you as a visitor who has full responsibility for the rules that apply while in the Nusantara Data Center area;</td></tr><tr><td>ii.</td><td>to facilitate or enable any verification that We consider necessary before We provide services to You;</td></tr><tr><td>iii.</td><td>to process and facilitate you including as applicable;</td></tr><tr><td>iv.</td><td>to notify You of activity that occurs within the Application or other systems connected to Our Visitor Application;</td></tr><tr><td>v.</td><td>to cultivate, process, complete the visit;</td></tr><tr><td>vi.</td><td>to communicate with You and send You information in connection with the use of Our Visitor Application;</td></tr><tr><td>vii.</td><td>to monitor and analyze your activities and behavior including activities that occur within the Nusantara Data Center area;</td></tr><tr><td>viii.</td><td>to generate statistical information and analytical data for the purpose of testing, research, analysis of Nusantara Data Center area visit activities;</td></tr><tr><td>ix.</td><td>to prevent, detect and investigate any suspicious activity or any prohibited, illegal, unauthorized or fraudulent activity;</td></tr><tr><td>x.</td><td>to enable Us to comply with all obligations under Applicable Laws and Regulations, including but not limited to responding to requests, investigations or rulings in accordance with regulations, complying with filing, reporting and licensing requirements required by law or Applicable Laws and conducting audit checks, due diligence; and</td></tr><tr><td>xi.</td><td>for other purposes that We notify You, and if required by Applicable Laws and Regulations, for which We obtain Your consent.</td></tr></table></p><p><strong>5. DISCLOSURE OF YOUR PERSONAL DATA</strong></p><p>We may disclose provide access to or share your Personal Data with affiliates and other parties for the following purposes as well as other purposes permitted by Applicable Laws and Regulations:</p><p><table><tr><th style='width:20px;'></th><th></th></tr><tr><td>a.</td><td>to provide services or process other needs including to contact you;</td></tr><tr><td>b.</td><td>respond to regulatory inquiries, questions, requests, investigations, decisions, reporting, to comply with filing requirements and conditions, as specified in the Applicable Laws and Regulations;</td></tr><tr><td>c.</td><td>if there are any legal proceedings of any kind between You and Us, or between You and any other party, in connection with, or relating to the service, for the purposes of such legal proceedings;</td></tr><tr><td>d.</td><td>in the event of an emergency relating to your health or safety, for the purposes of dealing with that emergency.</td></tr></table></p><p>If You receive Personal Data of other Users when using Our visit service, You understand and guarantee that such Personal Data will only be used for the purpose of using the service. You are fully responsible for any form of misuse of Personal Data that You do.</p><p>To the extent that it does not conflict with applicable laws and regulations, You release Us from all obligations related to Your misuse of Personal Data.</p><p><strong>6. DATA RETENTION</strong></p><p>Your Personal Data will only be retained for as long as necessary to fulfill the Purpose of the data collection and/or as long as such retention is required or permitted under Applicable Laws and Regulations. The system will automatically delete the data after the age of the data reaches 3 months (90 days) since the data began to be stored into the system.</p><p>We do not allow the Processing of Personal Data that is submitted and takes place outside of Our Visitor Application or that is not sent to Our official email. Visitors are therefore solely responsible for the Processing of such Personal Data.</p><p>To the extent permitted by Applicable Laws and Regulations, You release Us from and against any and all claims, losses, liabilities, costs, and damages resulting directly or indirectly from any activities conducted outside Our Application.</p><p><strong>7. DATA SECURITY</strong></p><p>The confidentiality of Your Personal Data is of utmost importance to Us. We will use best efforts to protect and secure Your Personal Data from access, collection, use or disclosure by unauthorized persons and from unlawful processing, accidental loss, destruction and damage or similar risks. However, as the transmission of data over the internet is not completely secure, We cannot fully guarantee that such Personal Data will not be intercepted, accessed, disclosed, altered or destroyed by unauthorized third parties, due to factors beyond Our control. You are responsible for maintaining the confidentiality of Your account details and You are obliged not to share Your account details and You must always maintain and be responsible for the security of the device You use.</p><p><strong>8. YOUR LEGAL RIGHTS</strong></p><p>You may have certain rights under Applicable Laws and Regulations to request Us for access to, correction of and/or deletion of Your Personal Data that is in Our possession and control. You may exercise these rights by contacting Us at the contacts provided in this Privacy Notice.</p><p>We may refuse Your request for access to, correction of and/or deletion of, some or all of Your Personal Data in Our possession or control if required or necessary under Applicable Laws and Regulations. This includes in circumstances where such Personal Data may contain references to other persons or where the request for access or request for correction or deletion is for reasons that We deem irrelevant, non-serious, or frivolous or indicated to be related to breach of terms of use or with activities or violations of law.</p><p>In accordance with Applicable Laws and Regulations, We have the right to any request for access and/or correction.</p><p><strong>9. HOW TO SUBMIT YOUR ACCOUNT DELETION REQUEST</strong></p><p>You may exercise Your right to delete Your account through Our Application. If You experience any difficulties during this process, including if You no longer have access to the Application, You may submit a request for deletion of Your account by submitting a request via Our official email.</p><p>We may reject your request based on the grounds permitted under the Applicable Laws and Regulations. This includes situations where we consider the request to be irrelevant, non-serious or frivolous, or if it relates to a breach of terms of use or unlawful activity.</p><p><strong>10. HOW TO CONTACT US</strong></p><p>If You have any questions or complaints in relation to this Privacy Notice or if You wish to exercise Your rights with respect to Your Personal Data, please contact Our authorized email.</p><p><strong>NDC JAKARTA (ndc.jakarta@moratelindo.co.id)</strong></p><p><strong>NDC BATAM (ndc.batam@moratelindo.co.id)</strong></p><p><strong>NDC SURABAYA (ndc.surabaya@moratelindo.co.id)</strong></p><p><strong>NDC MEDAN (ndc.medan@moratelindo.co.id)</strong></p><p><strong>NDC PALEMBANG (ndc.palembang@moratelindo.co.id)</strong></p><p><strong>NDC BALI (ndc.bali@moratelindo.co.id)</strong></p></div>";

                        Swal.fire({
                            title: "Terms and conditions",
                            html: htmlContent,
                            width: 850,
                            input: "checkbox",
                            inputValue: 0,
                            inputPlaceholder: "I agree to the collection and processing of my personal data for visit management purposes. I understand that this information will be used only for visit management purposes in accordance with the company's privacy policy. (Please read the Terms and Conditions)",
                            showDenyButton: true,
                            denyButtonText: 'No, cancel it.',
                            confirmButtonText: "Continue&nbsp;<i class='fa fa-arrow-right'></i>",
                            inputValidator: (result) => {
                                return !result && "You need to agree with T&C to continue";
                            }
                        }).then((result) => {
                            spinner.show();
                            if (result.isConfirmed) {
                                //console.log(result);
                                $.ajax({
                                    url: 'regis_moratel.php',
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    error: function() {
                                        alert("Connection failed!");
                                    },
                                    success: function(html) {
                                        $.unblockUI();
                                        spinner.hide();
                                        if (html == "success") {
                                            Swal.fire(
                                                'Yay!',
                                                'Your request has been submitted successfully',
                                                'success'
                                            ).then(function(result) {
                                                if (result.value) {
                                                    window.location =
                                                        "https://apps.ndcmoratelindo.com/?language=us";
                                                }
                                            })
                                        } else if (html == "failed") {
                                            Swal.fire(
                                                'Failed!',
                                                'Error when submitted your request to database',
                                                'error'
                                            )
                                        } else if (html == "error_captcha") {
                                            Swal.fire(
                                                'Failed!',
                                                'Survey form has been denied. Captcha code is wrong.',
                                                'error'
                                            )
                                        } else {
                                            //console.log(html)
                                            Swal.fire(
                                                'Error!',
                                                'There is empty data',
                                                'error'
                                            )
                                        }

                                    }
                                });
                            } else {
                                window.location = "https://apps.ndcmoratelindo.com/";
                            }
                        });
                    });


                    //console.log(checked);
                } else if (checked == "id") {

                    //ShowCam3();
                    //ShowCam4();


                    $("#form-survey-id").css("display", "block")
                    $("#form-survey-us").css("display", "none")
                    $("#captcha").css("display", "none").attr('required', false);
                    $("#captcha2").css("display", "block").attr('required', true);
                    $('#form-survey-id').submit(function(event) {
                        event.preventDefault();
                        var formData = new FormData(this);
                        formData.append('csrf_test_name', '9e2e8fdf78ce3e58848832ba3d78813c');

                        var htmlContent = document.createElement("div");
                        htmlContent.innerHTML = "<div align='justify' style='height:15em;overflow-y: scroll;width: 100%;font-size:12px;'><p><strong>Kebijakan Privasi Nusantara Data Center</strong></p><p><strong>Pengantar</strong></p><p>Pemberitahuan Kebijakan Privasi berikut ini menjelaskan bagaimana Kami, Nusantara Data Center memperoleh, mengumpulkan, menyimpan, menguasai, menggunakan, mengolah, menganalisa, memperbaiki, melakukan pembaruan dan melindungi Data Pribadi Anda.</p><p>Harap baca Kebijakan Privasi ini secara menyeluruh untuk memastikan bahwa Anda memahami praktik perlindungan data Kami.</p><p><strong>Pengakuan dan Persetujuan</strong></p><p>Dengan menyetujui Kebijakan Privasi, Anda mengakui bahwa Anda telah membaca dan memahami Kebijakan Privasi ini serta menyetujui segala ketentuannya. Secara khusus, Anda sepakat dan memberikan persetujuan kepada Kami untuk Memproses Data Pribadi Anda sesuai dengan Kebijakan Privasi ini.</p><p>Jika Anda menyediakan kepada Kami Data Pribadi yang berkaitan dengan individu lain (seperti Data Pribadi yang berkaitan degan pasangan Anda, anggota keluarga, teman, rekan kerja, karyawan atau pihak lain), maka Anda menyatakan dan menjamin bahwa Anda telah memperoleh persetujuan dari individu tersebut, dan dengan ini menyetujui atas nama individu tersebut, untuk Pemrosesan Data Pribadi mereka oleh Kami. Kami dapat meminta bukti dari persetujuan tersebut kepada anda setiap saat.</p><p><strong>1. JENIS-JENIS DATA PRIBADI YANG KAMI KUMPULKAN</strong></p><p>Sepanjang diizinkan oleh Peraturan Perundang-undagan yang Berlaku, Kami dapat memproses, mengumpulkan, menggunakan, dan menyimpan jenis-jenis berbeda dari Data Pribadi yang terdiri dari Data Pribadi umum dan spesifik tentang Anda yang telah Kami kategorikan sebagai berikut:</p><p><strong>a. Data Identitas</strong>a.termasuk nama, nama pengguna (username), kartu tanda penduduk, 	identitas Pengguna atau pengenal lainnya, jabatan, tanggal kelahiran, jenis kelamin, tempat	kelahiran, pekerjaan, kebangsaan, foto pribadi dan foto Tanda Pengenal Pribadi/Kartu	Tanda Penduduk/Paspor.</p><p><strong>b. Data Kontak</strong> b.termasuk alamat pribadi, alamat perusahaan tempat bekerja saat ini, alamat	email, nomor telepon pribadi dan nomor telepon yang terhubung dengan aplikasi	 Whatsapp.</p><p><strong>2. JIKA ANDA MENYEDIAKAN DATA PRIBADI YANG TIDAK LENGKAP</strong></p><p>Ketika Kami perlu mengumpulkan Data Pribadi berdasarkan hukum, atau berdasarkan ketentuan perjanjian yang Kami miliki dengan Anda, dan Anda memilih untuk tidak menyediakan Data Pribadi tersebut atau menyediakan Data Pribadi yang tidak lengkap kepada Kami saat diminta, maka kami tidak dapat memberi Anda izin untuk masuk ke area milik Nusantara Data Center, Kami tidak dapat menyediakan layanan dan melaksanakan perjanjian yang ada atau yang sedang dalam proses untuk Kami sepakati dengan Anda.</p><p><strong>3. BAGAIMANA KAMI MENGUMPULKAN DATA PRIBADI ANDA</strong></p><p>Data Pribadi yang Kami kumpulkan dapat diberikan oleh Anda melalui aplikasi Visitor Nusantara Data Center (apps.ndcmoratelindo.com) setiap kali pada saat Anda akan memasuki area Nusantara Data Center atau data yang dikirimkan ke email resmi Kami untuk tujuan pendaftaran Visitor Nusantara Data Center.</p><pJika pada saat kunjungan ada lebih dari 1 (satu) orang, maka Anda harus bersedia untuk mengikutsertakan individu-individu tersebut dan menyertakan data tentang pihak ketiga yang ikut dalam kunjungan Anda. Dalam kondisi tersebut, Anda tentu saja akan memerlukan persetujuan dari individu pihak ketiga lainnya tersebut -lihat “Pengakuan dan Persetujuan” di atas, untuk informasi lebih lanjut..</p><p><strong>4. BAGAIMANA KAMI MENGGUNAKAN DATA PRIBADI ANDA</strong></p><p>Kami dapat menggunakan Data Pribadi yang dikumpulkan untuk tujuan sebagai berikut:</p><p><table><tr><th style='width:20px;'></th><th></th></tr><tr><td>i.</td><td>untuk mengidentifikasi dan mendaftarkan Anda sebagai pengunjung yang memiliki tanggung jawab penuh terhadap aturan yang berlaku selama di dalam area Nusantara Data Center;</td></tr><tr><td>ii.</td><td>untuk memfasilitasi atau memungkinkan verifikasi apapun yang menurut	pertimbangan Kami diperlukan sebelum Kami menyediakan layanan kepada Anda;</td></tr><tr><td>iii.</td><td>untuk mengolah dan memfasilitasi Anda termasuk sebagaimana berlaku;</td></tr><tr><td>iv.</td><td>untuk memberitahu Anda atas aktivitas yang terjadi dalam Aplikasi atau sistem	lain yang terhubung dengan Aplikasi Visitor Kami;</td></tr><tr><td>v.</td><td>untuk mengolah, memproses, menyelesaikan kunjungan;</td></tr><tr><td>vi.</td><td>untuk berkomunikasi dengan Anda dan mengirimkan Anda informasi sehubungan dengan penggunaan Aplikasi Visitor Kami;</td></tr><tr><td>vii.</td><td>untuk memantau dan menganalisis aktivitas dan perilaku Anda termasuk kegiatan yang terjadi di dalam area Nusantara Data Center;</td></tr><tr><td>viii.</td><td>untuk menghasilkan informasi statistik dan data analitik untuk tujuan pengujian, penelitian, analisis aktivitas kunjungan area Nusantara Data Center;</td></tr><tr><td>ix.</td><td>untuk mencegah, mendeteksi dan menyelidiki segala aktivitas yang mencurigakan atau kegiatan yang dilarang, ilegal, tidak sah, atau curang;</td></tr><tr><td>x.</td><td>untuk memungkinkan Kami mematuhi semua kewajiban berdasarkan Peraturan Perundang-undangan yang Berlaku, termasuk namun tidak terbatas pada menanggapi permintaan, penyelidikan, atau keputusan sesuai dengan peraturan, mematuhi persyaratan pengarsipan, pelaporan, dan perizinan yang disyaratkan oleh hukum atau Peraturan Perundang-Undangan yang Berlaku dan melakukan pemeriksaan audit, uji tuntas; dan</td></tr><tr><td>xi.</td><td>untuk tujuan lain yang Kami beritahukan kepada Anda, dan apabila disyaratkan oleh Peraturan Perundang-undangan yang Berlaku, yang Kami memperoleh persetujuannya dari Anda.</td></tr></table></p><p><strong>5. PENGUNGKAPAN DATA PRIBADI ANDA</strong></p><p>Kami dapat mengungkapkan memberikan akses atau membagikan Data Pribadi Anda dengan afiliasi dan pihak lain untuk tujuan sebagai berikut serta tujuan lain yang diizinkan oleh Peraturan Perundang-undangan yang Berlaku:</p><p><table><tr><th style='width:20px;'></th><th></th></tr><tr><td>a.</td><td>untuk memberikan pelayanan atau memproses kebutuhan lain termasuk untuk menghubungi Anda;</td></tr><tr><td>b.</td><td>menanggapi pertanyaan terkait regulasi, pertanyaan, permintaan, penyelidikan, keputusan, pelaporan, untuk mematuhi persyaratan dan ketentuan pengarsipan, sebagaimana yang ditentukan dalam Peraturan Perundang-undangan yang Berlaku;</td></tr><tr><td>c.</td><td>jika terdapat proses hukum dalam bentuk apapun antara Anda dengan Kami, atau antara Anda dengan pihak lain, sehubungan dengan, atau terkait dengan layanan, untuk keperluan proses hukum tersebut;</td></tr><tr><td>d.</td><td>dalam keadaan darurat terkait kesehatan atau keselamatan Anda, untuk keperluan menangani keadaan darurat tersebut.</td></tr></table></p><p>Jika Anda menerima Data Pribadi Pengguna lain saat menggunakan layanan kunjungan Kami, Anda memahami dan menjamin bahwa Data Pribadi Tersebut hanya akan digunakan untuk tujuan penggunaan layanan. Anda bertanggung jawab sepenuhnya atas segala bentuk penyalahgunaan Data Pribadi yang Anda lakukan.</p><p>Sepanjang tidak bertentangan dengan peraturan perundang-undangan yang berlaku, Anda melepaskan Kami dari segala kewajiban terkait dengan penyalahgunaan Data Pribadi yang Anda lakukan.</p><p><strong>6. RETENSI DATA</strong></p><p>Data Pribadi Anda hanya akan disimpan selama diperlukan untuk memenuhi Tujuan dari pengumpulan data dan/atau selama penyimpanan tersebut diperlukan atau diperbolehkan menurut Peraturan Perundang-undangan yang Berlaku. Sistem akan secara otomatis menghapus data tersebut setelah usia data mencapai 3 bulan (90 hari) sejak data mulai disimpan ke dalam sistem.</p><p>Kami tidak mengizinkan Pemrosesan Data Pribadi yang disampaikan dan terjadi di luar Aplikasi Visitor Kami atau yang tidak dikirim ke email resmi Kami. Oleh karena itu pengunjung bertanggung jawab penuh terhadap Pemrosesan Data Pribadi tersebut.</p><p>Sepanjang diizinkan oleh Peraturan Perundang-undangan yang Berlaku, Anda membebaskan Kami dari dan terhadap setiap dan segala klaim, kerugian, kewajiban, biaya, dan kerusakan yang dihasilkan secara langsung atau tidak langsung dari setiap aktivitas yang dilakukan di luar Aplikasi Kami.</p><p><strong>7. KEAMANAN DATA</strong></p><p>Kerahasiaan Data Pribadi Anda adalah hal yang terpenting bagi Kami. Kami akan memberlakukan upaya terbaik untuk melindungi dan mengamankan Data Pribadi Anda dari akses, pengumpulan, penggunaan atau pengungkapan oleh orang-orang yang tidak berwenang dan dari pengolahan yang bertentangan dengan hukum, kehilangan yang tidak disengaja, pemusnahan dan kerusakan atau resiko serupa. Namun, dikarenakan pengiriman data melalui internet tidak sepenuhnya aman, Kami tidak dapat sepenuhnya menjamin bahwa Data Pribadi tersebut tidak akan dicegat, diakses, diungkapkan, diubah atau dihancurkan oleh pihak ketiga yang tidak berwenang, karena faktor-faktor di luar kendali Kami. Anda bertanggung jawab untuk menjaga kerahasiaan detail akun Anda dan Anda wajib untuk tidak membagikan detail akun Anda dan Anda harus selalu menjaga dan bertanggung jawab atas keamanan perangkat yang Anda gunakan.</p><p><strong>8. HAK HUKUM ANDA</strong></p><p>Anda mungkin memiliki hak tertentu berdasarkan Peraturan Perundang-undangan yang Berlaku untuk meminta kepada Kami terhadap akses kepada, koreksi dari dan/atau penghapusan terhadap Data Pribadi Anda yang berada dalam penguasaan dan kendali Kami. Anda dapat menggunakan hak-hak ini dengan menghubungi Kami pada kontak yang telah disediakan di Pemberitahuan Privasi ini.</p><p>Kami dapat menolak permintaan Anda terhadap akses kepada, koreksi dari dan/atau penghapusan terhadap, sebagian atau semua Data Pribadi Anda yang Kami kuasai atau kendalikan jika diwajibkan atau diperlukan berdasarkan Peraturan Perundang-undangan yang Berlaku. Hal ini termasuk dalam keadaan di mana Data Pribadi tersebut dapat berisi referensi kepada orang lain atau di mana permintaan untuk akses atau permintaan untuk mengoreksi atau menghapus adalah untuk alasan yang Kami anggap tidak relevan, tidak serius, atau mengada-ada atau terindikasi terkait tindakan pelanggaran ketentuan penggunaan atau dengan aktivitas atau pelanggaran hukum.</p><p>Sesuai Peraturan Perundang-undangan yang Berlaku, Kami memiliki hak untuk setiap permintaan akses dan/atau koreksi.</p><p><strong>9. CARA MENGAJUKAN PERMINTAAN PENGHAPUSAN AKUN ANDA</strong></p><p>Anda dapat menggunakan hak Anda untuk menghapus akun Anda melalui Aplikasi Kami. Jika Anda mengalami kesulitan selama proses ini, termasuk jika Anda tidak lagi memiliki akses ke Aplikasi, Anda dapat mengajukan permintaan penghapusan akun Anda dengan mengirimkan permintaan melalui email resmi Kami.</p><p>Kami dapat menolak permintaan Anda berdasarkan alasan yang diperbolehkan sesuai Peraturan Perundang-undangan yang Berlaku. Hal ini termasuk situasi di mana kami menganggap permintaan tersebut tidak relevan, tidak serius atau mengada-ada, atau jika terkait dengan pelanggaran ketentuan penggunaan atau kegiatan yang melawan hukum.</p><p><strong>10. CARA MENGHUBUNGI KAMI</strong></p><p>Jika Anda memiliki pertanyaan atau keluhan sehubungan dengan Pemberitahuan Privasi ini atau jika Anda ingin menggunakan hak-hak Anda terhadap Data Pribadi Anda, harap hubungi email resmi Kami sesuai dengan regional data center yang dikunjungi.</p><p><strong>NDC JAKARTA (ndc.jakarta@moratelindo.co.id)</strong></p><p><strong>NDC BATAM (ndc.batam@moratelindo.co.id)</strong></p><p><strong>NDC SURABAYA (ndc.surabaya@moratelindo.co.id)</strong></p><p><strong>NDC MEDAN (ndc.medan@moratelindo.co.id)</strong></p><p><strong>NDC PALEMBANG (ndc.palembang@moratelindo.co.id)</strong></p><p><strong>NDC BALI (ndc.bali@moratelindo.co.id)</strong></p></div>";

                        Swal.fire({
                            title: "Syarat dan Ketentuan",
                            html: htmlContent,
                            width: 850,
                            input: "checkbox",
                            inputValue: 0,
                            inputPlaceholder: "Saya setuju dengan pengumpulan dan pemrosesan data pribadi saya untuk keperluan pengelolaan kunjungan. Saya memahami bahwa informasi ini akan digunakan hanya untuk tujuan manajemen kunjungan sesuai dengan kebijakan privasi perusahaan. (Mohon membaca Syarat dan Ketentuan)",
                            showDenyButton: true,
                            denyButtonText: 'Tidak, batalkan.',
                            confirmButtonText: "Lanjutkan&nbsp;<i class='fa fa-arrow-right'></i>",
                            inputValidator: (result) => {
                                return !result && "Anda harus menyetujui S&K untuk melanjutkan";
                            }
                        }).then((result) => {
                            spinner.show();
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: 'regis_moratel.php',
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    error: function() {
                                        alert("Connection failed!");
                                    },
                                    success: function(html) {
                                        $.unblockUI();
                                        spinner.hide();
                                        if (html == "success") {
                                            Swal.fire(
                                                'Hore!',
                                                'Permintaan anda sudah berhasil disimpan!',
                                                'success'
                                            ).then(function(result) {
                                                if (result.value) {
                                                    window.location =
                                                        "https://apps.ndcmoratelindo.com/?language=id";
                                                }
                                            })
                                        } else if (html == "failed") {
                                            Swal.fire(
                                                'Gagal!',
                                                'Kesalahan saat mengirim data ke dalam database',
                                                'error'
                                            )
                                        } else if (html == "error_captcha") {
                                            Swal.fire(
                                                'Gagal!',
                                                'Form survey ditolak. Kode captcha salah.',
                                                'error'
                                            )
                                        } else {
                                            Swal.fire(
                                                'Terjadi Kesalahan!',
                                                'Ada data kosong',
                                                'error'
                                            )
                                        }

                                    }
                                });
                            } else {
                                window.location = "https://apps.ndcmoratelindo.com/";
                            }
                        });
                    });
                    //console.log(checked);
                } else {

                    //ShowCam();
                    //ShowCam2();

                    $("#form-survey-us").css("display", "block");
                    $("#form-survey-id").css("display", "none");
                    $("#captcha").css("display", "block").attr('required', true);
                    $("#captcha2").css("display", "none").attr('required', false);
                    $('#form-survey-us').submit(function(event) {
                        event.preventDefault();
                        var formData = new FormData(this);
                        formData.append('csrf_test_name', '9e2e8fdf78ce3e58848832ba3d78813c');
                        $.blockUI();
                        $.ajax({
                            url: 'regis_moratel.php',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            cache: false,
                            error: function() {
                                alert("Connection failed!");
                            },
                            success: function(html) {
                                $.unblockUI();
                                if (html == "success") {
                                    Swal.fire(
                                        'Yay!',
                                        'Your request has been submitted successfully',
                                        'success'
                                    ).then(function(result) {
                                        if (result.value) {
                                            window.location =
                                                "https://apps.ndcmoratelindo.com/?language=us";
                                        }
                                    })
                                } else if (html == "failed") {
                                    Swal.fire(
                                        'Failed!',
                                        'Error when submitted your request to database',
                                        'error'
                                    )
                                } else if (html == "error_captcha") {
                                    Swal.fire(
                                        'Failed!',
                                        'Survey form has been denied. Captcha code is wrong.',
                                        'error'
                                    )
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There is empty data',
                                        'error'
                                    )
                                }

                            }
                        });
                        return false;
                    });
                    //console.log(checked);
                }
            });
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.Litepicker && (new Litepicker({
                    element: document.getElementById('datepicker-icon'),
                    buttonText: {
                        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                    },
                }));

                window.Litepicker && (new Litepicker({
                    element: document.getElementById('datepicker-icon2'),
                    buttonText: {
                        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                    },
                }));

                window.Litepicker && (new Litepicker({
                    element: document.getElementById('datepicker-icon-out'),
                    buttonText: {
                        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                    },
                }));

                window.Litepicker && (new Litepicker({
                    element: document.getElementById('datepicker-icon-out2'),
                    buttonText: {
                        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                    },
                }));
            });
            // @formatter:on

                            function open_snapshot() {
                                $('#camera_desktop').show();
                                $('#result_desktop').hide();
                            }

                            function open_snapshot2() {
                                $('#camera_desktop2').show();
                                $('#result_desktop2').hide();
                            }

                            function take_snapshot() {
                                Webcam.snap(function(data_uri) {
                                    $('#camera_desktop').hide();
                                    $('#result_desktop').show();
                                    document.getElementById('results').innerHTML =
                                        '<img id="base64image" style="width:100%" src="' +
                                        data_uri +
                                        '"/>';
                                });
                            }

                            function take_snapshot2() {
                                Webcam.snap(function(data_uri) {
                                    $('#camera_desktop2').hide();
                                    $('#result_desktop2').show();
                                    document.getElementById('results2').innerHTML =
                                        '<img id="base64image2" style="width:100%" src="' +
                                        data_uri +
                                        '"/>';
                                });
                            }

                            function SaveSnap() {
                                //last id for files
                                let last_id = ["10081"];
                                let int_last_id = parseInt(last_id);
                                let max_id = (int_last_id + 1);
                                let str_last_id = max_id.toString();
                                //current date for files
                                let current_date = 202512031050753336;
                                let str_current = current_date.toString();
                                let unique = str_current + Date.now().toString(36) + Math.random().toString(16).slice(2);

                                //filename 
                                let filenames = unique.concat("_", str_last_id.concat("_", "photo.jpg"));

                                let form = document.getElementById("form-survey-us");
                                let files = document.getElementById("base64image").src;
                                let block = files.split(";");
                                let contentType = block[0].split(":")[1];
                                let realData = block[1].split(",")[1];

                                let blob = b64toBlob(realData, contentType);

                                document.getElementById('photo-personal').innerHTML =
                                    '<input type="file" id="input_photo" name="input_photo" hidden><img id="right-photo" src="' +
                                    files +
                                    '"/>';

                                let container = new DataTransfer();

                                let file = new File([blob], filenames, {
                                    type: "image/jpeg",
                                    lastModified: new Date().getTime()
                                });
                                container.items.add(file);

                                let fileInputElement = document.getElementById('input_photo');
                                fileInputElement.files = container.files;

                                $('#modal-success').modal('hide');
                            }

                            function SaveSnap2() {
                                //last id for files
                                let last_id = ["10081"];
                                let int_last_id = parseInt(last_id);
                                let max_id = (int_last_id + 1);
                                let str_last_id = max_id.toString();
                                //current date for files
                                let current_date = 202512031375575976;
                                let str_current = current_date.toString();
                                let unique = str_current + Date.now().toString(36) + Math.random().toString(16).slice(2);

                                //filename 
                                let filenames = unique.concat("_", str_last_id.concat("_", "ktp.jpg"));

                                let form = document.getElementById("form-survey-us");
                                let files = document.getElementById("base64image2").src;
                                let block = files.split(";");
                                let contentType = block[0].split(":")[1];
                                let realData = block[1].split(",")[1];

                                let blob = b64toBlob(realData, contentType);

                                document.getElementById('photo-ktp').innerHTML =
                                    '<input type="file" id="input_ktp" name="input_ktp" hidden><img id="right-ktp" src="' +
                                    files +
                                    '"/>';

                                let container = new DataTransfer();

                                let file = new File([blob], filenames, {
                                    type: "image/jpeg",
                                    lastModified: new Date().getTime()
                                });
                                container.items.add(file);

                                let fileInputElement = document.getElementById('input_ktp');
                                fileInputElement.files = container.files;

                                $('#modal-success2').modal('hide');
                            }

                            function ShowCam() {
                                Webcam.reset();
                                Webcam.set({
                                    width: 220,
                                    height: 330,
                                    image_format: 'jpeg',
                                    jpeg_quality: 100,
                                    constraints: {
                                        width: 220, // { exact: 320 },
                                        height: 320, // { exact: 180 },
                                        facingMode: 'user',
                                        frameRate: 30
                                    }
                                });
                                Webcam.attach('#my_camera');
                            }

                            function ShowCam2() {
                                Webcam.reset();
                                Webcam.set({
                                    width: 330,
                                    height: 190,
                                    image_format: 'jpeg',
                                    jpeg_quality: 100,
                                    constraints: {
                                        width: 320, // { exact: 320 },
                                        height: 180, // { exact: 180 },
                                        facingMode: 'environment',
                                        frameRate: 30
                                    }
                                });
                                Webcam.attach('#my_camera2');
                            }
                            function open_snapshot3() {
                                $('#camera_desktop3').show();
                                $('#result_desktop3').hide();
                            }

                            function open_snapshot4() {
                                $('#camera_desktop4').show();
                                $('#result_desktop4').hide();
                            }

                            function take_snapshot3() {
                                Webcam.snap(function(data_uri) {
                                    $('#camera_desktop3').hide();
                                    $('#result_desktop3').show();
                                    document.getElementById('results3').innerHTML =
                                        '<img id="base64image3" style="width:100%" src="' +
                                        data_uri +
                                        '"/>';
                                    // <button onclick="SaveSnap();">Save Snap</button>
                                });
                            }

                            function take_snapshot4() {
                                Webcam.snap(function(data_uri) {
                                    $('#camera_desktop4').hide();
                                    $('#result_desktop4').show();
                                    document.getElementById('results4').innerHTML =
                                        '<img id="base64image4" style="width:100%" src="' +
                                        data_uri +
                                        '"/>';
                                    // <button onclick="SaveSnap();">Save Snap</button>
                                });
                            }

                            function SaveSnap3() {
                                //last id for files
                                let last_id = ["10081"];
                                let int_last_id = parseInt(last_id);
                                let max_id = (int_last_id + 1);
                                let str_last_id = max_id.toString();
                                //current date for files
                                let current_date = 2025120396308986;
                                let str_current = current_date.toString();
                                let unique = str_current + Date.now().toString(36) + Math.random().toString(16).slice(2);

                                //filename 
                                let filenames = unique.concat("_", str_last_id.concat("_", "photo.jpg"));

                                let form = document.getElementById("form-survey-id");
                                let files = document.getElementById("base64image3").src;
                                let block = files.split(";");
                                let contentType = block[0].split(":")[1];
                                let realData = block[1].split(",")[1];

                                let blob = b64toBlob(realData, contentType);

                                document.getElementById('photo-personal2').innerHTML =
                                    '<input type="file" id="input_photo2" name="input_photo2" hidden><img id="right-personal2" src="' +
                                    files +
                                    '"/>';

                                let container = new DataTransfer();

                                let file = new File([blob], filenames, {
                                    type: "image/jpeg",
                                    lastModified: new Date().getTime()
                                });
                                container.items.add(file);

                                let fileInputElement = document.getElementById('input_photo2');
                                fileInputElement.files = container.files;

                                $('#modal-success3').modal('hide');
                            }

                            function SaveSnap4() {
                                //last id for files
                                let last_id = ["10081"];
                                let int_last_id = parseInt(last_id);
                                let max_id = (int_last_id + 1);
                                let str_last_id = max_id.toString();
                                //current date for files
                                let current_date = 202512031419319544;
                                let str_current = current_date.toString();
                                let unique = str_current + Date.now().toString(36) + Math.random().toString(16).slice(2);

                                //filename 
                                let filenames = unique.concat("_", str_last_id.concat("_", "ktp.jpg"));

                                let form = document.getElementById("form-survey-id");
                                let files = document.getElementById("base64image4").src;
                                let block = files.split(";");
                                let contentType = block[0].split(":")[1];
                                let realData = block[1].split(",")[1];

                                let blob = b64toBlob(realData, contentType);

                                document.getElementById('photo-ktp2').innerHTML =
                                    '<input type="file" id="input_ktp2" name="input_ktp2" hidden><img id="right-ktp2" src="' +
                                    files +
                                    '"/>';

                                let container = new DataTransfer();

                                let file = new File([blob], filenames, {
                                    type: "image/jpeg",
                                    lastModified: new Date().getTime()
                                });
                                container.items.add(file);

                                let fileInputElement = document.getElementById('input_ktp2');
                                fileInputElement.files = container.files;

                                $('#modal-success4').modal('hide');
                            }

                            function ShowCam3() {
                                Webcam.reset();
                                Webcam.set({
                                    width: 220,
                                    height: 330,
                                    image_format: 'jpeg',
                                    jpeg_quality: 100,
                                    constraints: {
                                        width: 220, // { exact: 320 },
                                        height: 320, // { exact: 180 },
                                        facingMode: 'user',
                                        frameRate: 30
                                    }
                                });
                                Webcam.attach('#my_camera3');
                            }

                            function ShowCam4() {
                                Webcam.reset();
                                Webcam.set({
                                    width: 330,
                                    height: 190,
                                    image_format: 'jpeg',
                                    jpeg_quality: 100,
                                    constraints: {
                                        width: 320, // { exact: 320 },
                                        height: 180, // { exact: 180 },
                                        facingMode: 'environment',
                                        frameRate: 30
                                    }
                                });
                                Webcam.attach('#my_camera4');
                            }
