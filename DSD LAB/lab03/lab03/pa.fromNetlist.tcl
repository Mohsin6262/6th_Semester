
# PlanAhead Launch Script for Post-Synthesis pin planning, created by Project Navigator

create_project -name lab03 -dir "D:/Semester Data/6th semester/DSD LAB/lab03/lab03/planAhead_run_2" -part xc6slx9csg324-2
set_property design_mode GateLvl [get_property srcset [current_run -impl]]
set_property edif_top_file "D:/Semester Data/6th semester/DSD LAB/lab03/lab03/buffer.ngc" [ get_property srcset [ current_run ] ]
add_files -norecurse { {D:/Semester Data/6th semester/DSD LAB/lab03/lab03} }
set_param project.pinAheadLayout  yes
set_property target_constrs_file "buffer.ucf" [current_fileset -constrset]
add_files [list {buffer.ucf}] -fileset [get_property constrset [current_run]]
link_design
