
    <?php $this->load->view('mainadmin/header.php');?>
	
	 <?php $this->load->view('mainadmin/topmenu.php');?>
	 
	<?php $this->load->view('mainadmin/sidebar.php');?>
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Circular</h6>
								<hr>
                                
						<form>
								
						    <div class="form-group">
                                <label>Reference Number</label>
                                <input class="form-control" type="text" placeholder="Reference Number">
                            </div>
								
                            <div class="form-group">
                                <label>Circular Title</label>
                                <input class="form-control" type="text" placeholder="Circular Title">
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <select class="select select2-hidden-accessible">
								    <option value="">Select Department</option>
									<option value="1">Chairman CWC</option>
									<option value="2">Member (D &amp; R)</option>
									<option value="3">Member (R M)</option>
									<option value="4">Member (W P &amp; P)</option>
									<option value="5">C.E (Designs NW&amp;S)</option>
									<option value="6">C.E (Designs N&amp;W)</option>
									<option value="7">C.E (Designs E&amp;NE)</option>
									<option value="8">C.E (Dam Safety DSO)</option>
									<option value="9">C.E (HSO)</option>
									<option value="10">C.E (NBP)</option>
									<option value="11">C.E (BPMO)</option>
									<option value="12">C.E (CMO)</option>
									<option value="13">C.E (EMO)</option>
									<option value="14">C.E (IMO)</option>
									<option value="15">C.E (PAO)</option>
									<option value="16">C.E (PMO)</option>
									<option value="17">CE (PPO)</option>
									<option value="18">C.E (PO&amp;MIO)</option>
									<option value="19">Advisor ISO</option>
									<option value="20">C.E (FMO)</option>
									<option value="21">C.E (P&amp;D)</option>
									<option value="22">C.E (B&amp;BBO)</option>
									<option value="23">C.E (C&amp;SRO)</option>
									<option value="24">C.E (NWA)</option>
									<option value="25">C.E (IBO)</option>
									<option value="26">C.E (KGBO)</option>
									<option value="27">C.E (LGBO)</option>
									<option value="28">C.E (M&amp;ERBO)</option>
									<option value="29">C.E (Mon Central Org)</option>
									<option value="30">C.E (Mon South Org)</option>
									<option value="31">C.E (NBO)</option>
									<option value="32">C.E (N&amp;TBO)</option>
									<option value="33">C.E (TBO)</option>
									<option value="34">C.E (UGBO)</option>
									<option value="35">C.E (YBO)</option>
									<option value="36">SECRETARY(CWC)</option>
									<option value="37">DIRECTOR (TRG.)</option>
									<option value="38">DIRECTOR (ADMN.)</option>
									<option value="39">Director(TC)</option>
									<option value="40">DD (LIB.)</option>
									<option value="41">DD(WPC)</option>
									<option value="42">DD(Software Group)</option>
									<option value="43">DD(OL)</option>
									<option value="44">ACCTS. OFFICER</option>
									<option value="45">US (CM&amp;V)</option>
									<option value="46">US.(E-I )</option>
									<option value="47">US.(E- II)</option>
									<option value="48">U.S.(E-III )</option>
									<option value="49">US(E.IV)</option>
									<option value="50">U.S.( E-V)</option>
									<option value="51">U.S.(E.VI)</option>
									<option value="52">U.S.(E.VII)</option>
									<option value="53">U.S.(E.VIII )</option>
									<option value="54">US (E-IX )</option>
									<option value="55">US (E.X)</option>
									<option value="56">U.S.(E.XI)</option>
									<option value="57">U.S.(E.XII)</option>
									<option value="58">U.S.(O&amp;M)</option>
									<option value="59">U.S.(R&amp;I)</option>
									<option value="63">S.O.(CRU)</option>
									<option value="64">S.O (APAR)</option>
									<option value="65">S.O.(A/C-I)</option>
									<option value="66">S.O.(A/C-II)</option>
									<option value="67">S.O.(A/C-III)</option>
									<option value="68">S.O.(A/C-IV)</option>
									<option value="69">S.O.(A/C.WORKS)</option>
									<option value="70">S.O.(BUDGET)</option>
									<option value="71">HINDI SECTION</option>
									<option value="72">RD DTE</option>
									<option value="73">SM DTE (and Others)</option>
									<option value="74">PCP DTE</option>
									<option value="75">TD DTE</option>
									<option value="76">MoWR</option>
                                </select>
                            </div>
                          
							<div class="form-group">
                                <label>Upload Circular</label>
                                <div>
                                    <input class="form-control" type="file">
                                </div>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary btn-lg">Post Circular</button>
                            </div>
                        </form>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      
<?php $this->load->view('mainadmin/footer.php');?>	
