                            <?php $no=1; foreach ($data as $val) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <!-- <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-toggle="modal" data-target=".exampleModal"><i class="bx bx-show"></i> Preview</button>
                                </td> -->
                                <td class="text-left" style="width: 30%;">
                                    <a href="javascript(void)" id="infojenis" data-toggle="modal" data-id="<?php echo $val['id'];?>"><h5 class="limit-2-line-text font-size-14 mb-1"><?= $val['nama'] ?></h5></a>
                                </td>
                                <td class="text-left" style="width: 40%;">
                                    <p class="limit-2-line-text mb-0"><?= $val['nama_hak'] ?></p>
                                </td>
                                <td class="text-left" style="width: 30%;">
                                    <p class="limit-2-line-text mb-0"><?= $val['nama_subyek'] ?></p>
                                </td>
                            </tr>
                            <?php } ?>